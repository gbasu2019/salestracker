import { Component, ViewChild } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { Http } from '@angular/http';
import { DatePipe } from '@angular/common';
import { HomePage } from '../home/home';
import { environment } from '../../app/environments/environments';
import { Chart } from 'chart.js';

let getOrderListAPI = environment.apiHost + '/getOrderList';

@Component({

  templateUrl: 'orderlist.html'
})

export class OrderListPage {
  orders: any = [];
  product: any = []
  item: any = {};
  hide: boolean = false;
  dealername: any;
  brandname: any;
  startDate: String;
  endDate: String = new Date().toISOString();
  date: Date;
  search: any = {}
  setDob: String;
  setStatrtDob: string;
  setEndrtDob: string;
  statuslist: any;
  visibleid: any;
  orderstatusname: any;
  dealerlist: string;
  users: any = {};
  usergrpId: any;
  data: Array<{ FullName: string, OrderID: number, OrderNo: string, OrderDate: string, OrderStatus: string, Quantity: number, dealername: string, icon: string, showDetails: boolean, product: any }> = [];
  dataval: any = [];
  orderCount0: any;
  orderCount: any;
  orderCount1: any;
  orderCount2: any;
  orderCount3: any;
  constructor(public http: Http, public datePipe: DatePipe, public navCtrl: NavController) {
    this.dealerlist = JSON.parse(localStorage.getItem('dealers'));
    if (localStorage.getItem('users')) {
      this.users = JSON.parse(localStorage.getItem('users'));
    }
    else {
      this.users = '';
    }
    this.getStatusList();
    this.search.orderstatus = localStorage.getItem('order_status');
  }
  @ViewChild('pieCanvas') pieCanvas;
  pieChart: any;
  ionViewDidLoad() {

    this.pieChart = this.getPieChart();


  }
  getPieChart() {

    var getWeeklyTotalOrderAPI = environment.apiHost + '/getWeeklyTotalOrder';
    var getWeeklyApprovedOrderAPI = environment.apiHost + '/getWeeklyApprovedOrder';
    var getWeeklyRejectedAPI = environment.apiHost + '/getWeeklyRejectedOrder';
    var getWeeklyOpenAPI = environment.apiHost + '/getWeeklyOpenOrder';
    var getWeekPartiallyAPI = environment.apiHost + '/getWeekPartiallyOrder';


    this.http.get(getWeeklyTotalOrderAPI)
      .subscribe(data => {
        this.dataval = JSON.parse(data['_body']);

        for (var i = 0; i < this.dataval.length; i++) {

          this.orderCount = this.dataval[i].ordercount;

          localStorage.setItem('orderWeekCount', this.orderCount);

        }

      });
    this.http.get(getWeeklyApprovedOrderAPI)
      .subscribe(data => {
        this.dataval = JSON.parse(data['_body']);

        for (var i = 0; i < this.dataval.length; i++) {

          this.orderCount3 = this.dataval[i].ordercount;

          localStorage.setItem('orderWeekApprovedCount', this.orderCount3);

        }

      });
    this.http.get(getWeeklyRejectedAPI)
      .subscribe(data => {
        this.dataval = JSON.parse(data['_body']);

        for (var i = 0; i < this.dataval.length; i++) {

          this.orderCount2 = this.dataval[i].ordercount;

          localStorage.setItem('orderWeekRejectedCount', this.orderCount2);

        }

      });
    this.http.get(getWeeklyOpenAPI)
      .subscribe(data => {
        this.dataval = JSON.parse(data['_body']);

        for (var i = 0; i < this.dataval.length; i++) {

          this.orderCount1 = this.dataval[i].ordercount;

          localStorage.setItem('orderWeekOpenCount', this.orderCount1);

        }

      });
    this.http.get(getWeekPartiallyAPI)
      .subscribe(data => {
        this.dataval = JSON.parse(data['_body']);

        for (var i = 0; i < this.dataval.length; i++) {

          this.orderCount0 = this.dataval[i].ordercount;

          localStorage.setItem('orderWeekPartiallyCount', this.orderCount0);

        }

      });
    console.log(localStorage.getItem('orderWeekCount'));
    console.log(localStorage.getItem('orderWeekApprovedCount'));
    console.log(localStorage.getItem('orderWeekRejectedCount'));
    console.log(localStorage.getItem('orderWeekOpenCount'));
    console.log(localStorage.getItem('orderWeekPartiallyCount'));
    let data = {
      labels: ["Approved", "Canceled", "Open", "Partially Fulfilled"],
      datasets: [
        {
          data: [localStorage.getItem('orderWeekApprovedCount'), localStorage.getItem('orderWeekRejectedCount'), localStorage.getItem('orderWeekOpenCount'), localStorage.getItem('orderWeekPartiallyCount')],
          backgroundColor: ["#36A2EB", "#FFCE56", "#EEBE89", "#0612FB"],
          hoverBackgroundColor: ["#36A2EB", "#FFCE56", "#EEBE89", "#0612FB"]
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
  gotohomepage() {
    this.navCtrl.setRoot(HomePage);
  }

  /**==populate the list when page load== */
  ngOnInit() {
    this.usergrpId = localStorage.getItem('usergroupid');
    this.orderstatusname = "All";

    this.date = new Date();
    this.search.endDate = this.endDate;
    this.search.startDate = new Date(this.date.getTime() - 3 * 24 * 60 * 60 * 1000).toISOString();
    this.brandname = localStorage.getItem('brandname');
    this.setStatrtDob = this.datePipe.transform(this.search.startDate, 'yyyy-MM-dd');
    this.setEndrtDob = this.datePipe.transform(this.search.endDate, 'yyyy-MM-dd');

    if (localStorage.getItem('usergroupid') == '1') {
      var getOrderListData = JSON.stringify({ userid: 0, usergroupid: localStorage.getItem('usergroupid'), dealerid: 0, startDate: this.setStatrtDob, endDate: this.setEndrtDob, orderstatus: this.search.orderstatus });
    }
    else {
      var getOrderListData = JSON.stringify({ userid: localStorage.getItem('pkuserid'), usergroupid: localStorage.getItem('usergroupid'), dealerid: 0, startDate: this.setStatrtDob, endDate: this.setEndrtDob, orderstatus: this.search.orderstatus });
    }

    this.generateOrderlist(getOrderListAPI, getOrderListData);

  }
  goToSlide() {


    if (!this.search.selectedDealer) {
      this.search.selectedDealer = 0;
    }
    this.search.startDate = new Date(this.date.getTime() - 7 * 24 * 60 * 60 * 1000).toISOString();
    this.setStatrtDob = this.datePipe.transform(this.search.startDate, 'yyyy-MM-dd');
    var getOrderListData = JSON.stringify({ userid: 0, usergroupid: localStorage.getItem('usergroupid'), dealerid: 0, startDate: this.setStatrtDob, endDate: this.setEndrtDob, orderstatus: this.search.orderstatus });
    this.generateOrderlist(getOrderListAPI, getOrderListData);
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
    this.navCtrl.push(OrderListPage);
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
      var getOrderListData = JSON.stringify({ userid: this.search.user, usergroupid: localStorage.getItem('usergroupid'), dealerid: this.search.selectedDealer, startDate: this.setStatrtDob, endDate: this.setEndrtDob, orderstatus: this.search.orderstatus, ordernumber: this.search.ordernumber });
    }
    else {
      var getOrderListData = JSON.stringify({ userid: localStorage.getItem('pkuserid'), usergroupid: localStorage.getItem('usergroupid'), dealerid: this.search.selectedDealer, startDate: this.setStatrtDob, endDate: this.setEndrtDob, orderstatus: this.search.orderstatus, ordernumber: this.search.ordernumber });
    }


    this.generateOrderlist(getOrderListAPI, getOrderListData);

  }

  /**===== end ====== */


  /** ======= common function for generate orderlist function for listing order ===== */
  generateOrderlist(getOrderListAPI, getOrderListData) {
    this.http.post(getOrderListAPI, getOrderListData)
      .subscribe(data => {

        this.item = JSON.parse(data['_body'])

        this.orders.length = 0;
        this.product.length = 0;
        this.data.length = 0;

        for (var l = 0; l < this.item.length; l++) {
          this.orders = this.item[l].orderlist;

          if (this.orders.length > 0) {
            for (let i = 0; i < this.orders.length; i++) {
              this.data.push({
                FullName: this.orders[i].FullName,
                OrderID: this.orders[i].OrderID,
                OrderNo: this.orders[i].OrderNo,
                OrderDate: this.orders[i].OrderDate,
                OrderStatus: this.orders[i].OrderStatus,
                Quantity: this.orders[i].Quantity,
                dealername: this.orders[i].DealerName,
                icon: 'ios-add-circle-outline',
                showDetails: false,
                product: this.orders[i].detaillist
              });
            }
          }


        }

      }, error => {
        console.log(error);

      });
  }


  /**=====status list population======= */
  getStatusList() {
    var getStatusDropDownAPI = environment.apiHost + '/getStatusDropDown';
    var getStatusDropDownData = JSON.stringify({ statustype: 'Order' });

    this.http.post(getStatusDropDownAPI, getStatusDropDownData)
      .subscribe(data => {

        this.item = JSON.parse(data['_body'])

        for (var a = 0; a < this.item.length; a++) {
          this.statuslist = this.item[a].orderstatuslist;
          for (var k = 0; k < this.statuslist.length; k++) {

            localStorage.setItem("order_status", this.statuslist[0].PK_StatusID);
          }
        }

      }, error => {
        console.log(error);

      });
  }

}