import { Component, ViewChild } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { DatePipe } from '@angular/common';
import { Http } from '@angular/http';
import { HomePage } from '../home/home';
import { environment } from '../../app/environments/environments';
import { ImageViewerController } from "ionic-img-viewer";
import { Chart } from 'chart.js';
let getCollectionListAPI = environment.apiHost + '/getCollectionList';
/**
 * Generated class for the CollectionlistPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-collectionlist',
  templateUrl: 'collectionlist.html',
})
export class CollectionlistPage {

  @ViewChild('pieCanvas') pieCanvas;
  hide: boolean = false;
  pieChart: any;
  startDate: String;
  endDate: String = new Date().toISOString();
  date: Date;
  dealername: any;
  dealerlist: String;
  search: any = {};
  setStatrtDob: string;
  setEndrtDob: string;
  item: any = {};
  collectionlist: any = [];
  status: any;
  collectiondata: any = [];
  TotalCash: any;
  BankCash: any;
  CashAmount: any;
  usergrpId: any;
  users: any = [];
  data: any = [];
  dataval: any = [];
  collectionCount2: any;
  collectionCount3: any;
  collectionCount: any;
  constructor(public navCtrl: NavController, public navParams: NavParams, public datePipe: DatePipe, public http: Http, public imageViewerCtrl: ImageViewerController) {

  }

  ionViewDidLoad() {

    this.pieChart = this.getPieChart();

  }
  getPieChart() {

    var getMonthlyCollectionAPI = environment.apiHost + '/getMonthlyTotalCollection';
    var getCollectionCashAPI = environment.apiHost + '/getCollectionCash';
    var getCollectionBankAPI = environment.apiHost + '/getCollectionBank';



    this.http.get(getMonthlyCollectionAPI)
      .subscribe(data => {
        this.dataval = JSON.parse(data['_body']);

        for (var i = 0; i < this.dataval.length; i++) {

          this.collectionCount = this.dataval[i].collectioncount;

          localStorage.setItem('collectionCount', this.collectionCount);

        }

      });
    this.http.get(getCollectionCashAPI)
      .subscribe(data => {
        this.dataval = JSON.parse(data['_body']);

        for (var i = 0; i < this.dataval.length; i++) {

          this.collectionCount3 = this.dataval[i].collectioncount;

          localStorage.setItem('collectionCountCash', this.collectionCount3);

        }

      });
    this.http.get(getCollectionBankAPI)
      .subscribe(data => {
        this.dataval = JSON.parse(data['_body']);

        for (var i = 0; i < this.dataval.length; i++) {

          this.collectionCount2 = this.dataval[i].collectioncount;

          localStorage.setItem('collectionCountBank', this.collectionCount2);

        }

      });

    console.log(localStorage.getItem('collectionCount'));
    console.log(localStorage.getItem('collectionCountCash'));
    console.log(localStorage.getItem('collectionCountBank'));



    let data = {
      labels: ["Monthly", "Monthly Cash", "Monthly Bank"],
      datasets: [
        {
          data: [localStorage.getItem('collectionCount'), localStorage.getItem('collectionCountCash'), localStorage.getItem('collectionCountBank')],
          backgroundColor: ["#36A2EB", "#FFCE56", "#EEBE89"],
          hoverBackgroundColor: ["#36A2EB", "#FFCE56", "#EEBE89"]
        }]
    };

    return this.getChart(this.pieCanvas.nativeElement, "pie", data);

  }
  getChart(context, chartType, data, options?) {
    return new Chart(context, {
      type: chartType,
      data: data,
      options: options
    });

  }
  goToSlide() {


    if (!this.search.selectedDealer) {
      this.search.selectedDealer = 0;
    }
    this.search.startDate = new Date(this.date.getTime() - 30 * 24 * 60 * 60 * 1000).toISOString();
    this.setStatrtDob = this.datePipe.transform(this.search.startDate, 'yyyy-MM-dd');
    var getCollectionListData = JSON.stringify({ userid: localStorage.getItem('pkuserid'), usergroupid: localStorage.getItem('usergroupid'), dealerid: 0, startDate: this.setStatrtDob, endDate: this.setEndrtDob, orderstatus: this.search.orderstatus });
    this.getCollectionList(getCollectionListAPI, getCollectionListData);
  }
  ngOnInit() {
    this.dealerlist = JSON.parse(localStorage.getItem('dealers'));
    if (localStorage.getItem('users')) {
      this.users = JSON.parse(localStorage.getItem('users'));
    }
    else {
      this.users = '';
    }


    this.date = new Date();
    this.search.endDate = this.endDate;
    this.search.startDate = new Date(this.date.getTime() - 3 * 24 * 60 * 60 * 1000).toISOString();
    this.dealername = localStorage.getItem('dealername');
    this.search.orderstatus = "pending";
    this.setStatrtDob = this.datePipe.transform(this.search.startDate, 'yyyy-MM-dd');
    this.setEndrtDob = this.datePipe.transform(this.search.endDate, 'yyyy-MM-dd');
    this.usergrpId = localStorage.getItem('usergroupid');

    if (localStorage.getItem('usergroupid') == '1') {
      var getCollectionListData = JSON.stringify({ userid: 0, usergroupid: localStorage.getItem('usergroupid'), dealerid: 0, startDate: this.setStatrtDob, endDate: this.setEndrtDob, orderstatus: this.search.orderstatus });
    }
    else {
      var getCollectionListData = JSON.stringify({ userid: localStorage.getItem('pkuserid'), usergroupid: localStorage.getItem('usergroupid'), dealerid: 0, startDate: this.setStatrtDob, endDate: this.setEndrtDob, orderstatus: this.search.orderstatus });
    }

    this.getCollectionList(getCollectionListAPI, getCollectionListData);
  }
  ngIfCtrl() {
    this.hide = !this.hide;
  }

  gotohomepage() {
    this.navCtrl.setRoot(HomePage);
  }

  /**====== Search result ======== */
  SearchData() {

    this.setStatrtDob = this.datePipe.transform(this.search.startDate, 'yyyy-MM-dd');
    this.setEndrtDob = this.datePipe.transform(this.search.endDate, 'yyyy-MM-dd');
    if (!this.search.selectedDealer) {
      this.search.selectedDealer = 0;
    }


    if (localStorage.getItem('usergroupid') == '1') {
      if (!this.search.user) {
        this.search.user = 0

      }
      var getCollectionListData = JSON.stringify({ userid: this.search.user, usergroupid: localStorage.getItem('usergroupid'), dealerid: this.search.selectedDealer, startDate: this.setStatrtDob, endDate: this.setEndrtDob });
    }
    else {
      var getCollectionListData = JSON.stringify({ userid: localStorage.getItem('pkuserid'), usergroupid: localStorage.getItem('usergroupid'), dealerid: this.search.selectedDealer, startDate: this.setStatrtDob, endDate: this.setEndrtDob });
    }


    this.getCollectionList(getCollectionListAPI, getCollectionListData);

  }
  getCollectionList(getCollectionListAPI, getCollectionListData) {

    console.log(getCollectionListData);
    this.http.post(getCollectionListAPI, getCollectionListData)
      .subscribe(data => {
        this.data.length = 0;
        this.item = JSON.parse(data['_body'])

        for (var i = 0; i < this.item.length; i++) {
          this.collectiondata = this.item[i].collectionlist;
          this.TotalCash = this.item[i].TotalCash;
          this.BankCash = this.item[i].BankCash;
          this.CashAmount = this.item[i].CashAmount;
          for (let k = 0; k < this.collectiondata.length; k++) {
            if (this.collectiondata[k].Referral_Image != "") {
              this.data.push({

                Referral_Image: environment.apiHost + "/" + this.collectiondata[k].Referral_Image,
                CreatedDate: this.collectiondata[k].CreatedDate,
                DealerName: this.collectiondata[k].DealerName,
                Collection_type: this.collectiondata[k].Collection_type,
                Cheque: this.collectiondata[k].Cheque,
                transactionID: this.collectiondata[k].transactionID,
                Bankname: this.collectiondata[k].Bankname,
                FullName: this.collectiondata[k].FullName,
                amount: this.collectiondata[k].amount,
              });
            }
            else {
              this.data.push({

                Referral_Image: "",
                CreatedDate: this.collectiondata[k].CreatedDate,
                DealerName: this.collectiondata[k].DealerName,
                Collection_type: this.collectiondata[k].Collection_type,
                Cheque: this.collectiondata[k].Cheque,
                transactionID: this.collectiondata[k].transactionID,
                Bankname: this.collectiondata[k].Bankname,
                FullName: this.collectiondata[k].FullName,
                amount: this.collectiondata[k].amount,
              });
            }


          }
          console.log(this.data);
          // this.collectiondata = this.item[k].collectionlist;
          // this.TotalCash = this.item[k].TotalCash;
          // this.BankCash = this.item[k].BankCash;
          // this.CashAmount = this.item[k].CashAmount;

        }




      }, error => {
        console.log(error);

      });
  }
  ResetData() {
    this.navCtrl.push(CollectionlistPage);
  }

}
