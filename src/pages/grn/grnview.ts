import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { Http } from '@angular/http';
import { DatePipe } from '@angular/common';
import { HomePage } from '../home/home';
import { environment } from '../../app/environments/environments';
let getGrnListAPI = environment.apiHost + '/getGrnList';
@IonicPage()
@Component({
  selector: 'page-grnview',
  templateUrl: 'grnview.html',
})
export class GrnviewPage {
  dealername: any;
  brandname: any;
  hide: boolean = false;
  item: any = {};
  search: any = {};
  grnlist: any = [];
  startDate: String;
  endDate: String = new Date().toISOString();
  date: Date;
  statuslist: any = {};
  setStatrtDob: string;
  setEndrtDob: string;
  dealerID: any;
  dealerlist: string;
  grnstatusname: any;
  users: any = {};
  usergrpId: any;
  product: any = [];
  data: Array<{ FullName: string, grnID: number, grnNo: string, grnDate: string, grnStatus: string, Quantity: number, icon: string, showDetails: boolean, product: any, DealerName: String }> = [];
  constructor(public datePipe: DatePipe, public navCtrl: NavController, public navParams: NavParams, public http: Http) {

    this.getStatusList();
    this.search.grnstatus = localStorage.getItem('grn_status');

    if (localStorage.getItem('users')) {
      this.users = JSON.parse(localStorage.getItem('users'));
    }
    else {
      this.users = '';
    }
  }
  /**==populate the list when page load== */
  ngOnInit() {

    this.grnstatusname = "All";
    this.date = new Date();
    this.search.endDate = this.endDate;
    this.search.startDate = new Date(this.date.getTime() - 3 * 24 * 60 * 60 * 1000).toISOString();
    this.dealername = localStorage.getItem('dealername');
    this.brandname = localStorage.getItem('brandname');
    this.dealerlist = JSON.parse(localStorage.getItem('dealers'));
    this.usergrpId = localStorage.getItem('usergroupid');
    this.search.selectedDealer = 0;
    this.setStatrtDob = this.datePipe.transform(this.search.startDate, 'yyyy-MM-dd');
    this.setEndrtDob = this.datePipe.transform(this.search.endDate, 'yyyy-MM-dd');
    if (localStorage.getItem('usergroupid') == '1') {
      var getGrnListData = JSON.stringify({ userid: 0, usergroupid: localStorage.getItem('usergroupid'), dealerid: 0, startDate: this.setStatrtDob, endDate: this.setEndrtDob, grnstatus: this.search.grnstatus });
    }
    else {
      var getGrnListData = JSON.stringify({ userid: localStorage.getItem('pkuserid'), usergroupid: localStorage.getItem('usergroupid'), dealerid: 0, startDate: this.setStatrtDob, endDate: this.setEndrtDob, grnstatus: this.search.grnstatus });
    }
    this.getGrnList(getGrnListAPI, getGrnListData);

  }

  /**==== toggle filter section ==== */
  ngIfCtrl() {
    this.hide = !this.hide;
  }
  /**=== toggle details section === */
  toggleDetails(data) {
    if (data.showDetails) {
      data.showDetails = false;
      data.icon = 'ios-add-circle-outline';
    } else {
      data.showDetails = true;
      data.icon = 'ios-remove-circle-outline';
    }
  }
  /**===reset button function call==== */
  ResetData() {
    this.navCtrl.push(GrnviewPage);
  }
  /**====== Search result ======== */
  SearchData() {
    this.setStatrtDob = this.datePipe.transform(this.search.startDate, 'yyyy-MM-dd');
    this.setEndrtDob = this.datePipe.transform(this.search.endDate, 'yyyy-MM-dd');
    var link = environment.apiHost + '/getGrnList';
    if (localStorage.getItem('usergroupid') == '1') {
      if (!this.search.user) {
        this.search.user = 0

      }
      var getGrnListData = JSON.stringify({ userid: this.search.user, usergroupid: localStorage.getItem('usergroupid'), dealerid: this.search.selectedDealer, startDate: this.setStatrtDob, endDate: this.setEndrtDob, grnstatus: this.search.grnstatus, invoicenumber: this.search.invoicenumber });
    }
    else {
      var getGrnListData = JSON.stringify({ userid: localStorage.getItem('pkuserid'), usergroupid: localStorage.getItem('usergroupid'), dealerid: this.search.selectedDealer, startDate: this.setStatrtDob, endDate: this.setEndrtDob, grnstatus: this.search.grnstatus, invoicenumber: this.search.invoicenumber });
    }
    // console.log(getGrnListData);
    this.getGrnList(getGrnListAPI, getGrnListData);

  }
  /**===== end ====== */
  gotohomepage() {
    this.navCtrl.setRoot(HomePage);
  }
  /**=====status list population======= */
  getStatusList() {
    var getStatusDropDownAPI = environment.apiHost + '/getStatusDropDown';
    var getStatusDropDownData = JSON.stringify({ statustype: 'Grn' });
    this.http.post(getStatusDropDownAPI, getStatusDropDownData)
      .subscribe(data => {

        this.item = JSON.parse(data['_body'])

        for (var a = 0; a < this.item.length; a++) {
          this.statuslist = this.item[a].orderstatuslist;
          for (var k = 0; k < this.statuslist.length; k++) {

            localStorage.setItem("grn_status", this.statuslist[0].PK_StatusID);

          }
        }

      }, error => {
        console.log(error);

      });
  }
  /** ======= common function for generate orderlist function for listing grn ===== */
  getGrnList(getGrnListAPI, getGrnListData) {

    this.http.post(getGrnListAPI, getGrnListData)
      .subscribe(data => {

        this.item = JSON.parse(data['_body']);
        this.grnlist.length = 0;
        this.product.length = 0;
        this.data.length = 0;
        for (var i = 0; i < this.item.length; i++) {
          this.grnlist = this.item[i].grnlist;

          for (let i = 0; i < this.grnlist.length; i++) {
            this.data.push({
              FullName: this.grnlist[i].FullName,
              grnID: this.grnlist[i].grnID,
              grnNo: this.grnlist[i].grnNo,
              grnDate: this.grnlist[i].grnDate,
              grnStatus: this.grnlist[i].grnStatus,
              Quantity: this.grnlist[i].Quantity,
              icon: 'ios-add-circle-outline',
              showDetails: false,
              DealerName: this.grnlist[i].DealerName,
              product: this.grnlist[i].detaillist
            });
          }


        }

      }, error => {
        console.log(error);

      });
  }

}
