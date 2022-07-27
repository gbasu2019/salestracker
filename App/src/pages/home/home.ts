import { Component, ViewChild } from '@angular/core';
import { NavController, LoadingController, Loading, AlertController } from 'ionic-angular';
import { Chart } from 'chart.js';
import { Http, Headers } from '@angular/http';
import { OrderListPage } from '../order/orderlist';
import { ProductListPage } from '../stock/productlist';
import { ReportPage } from '../report/reportpage';
import { LoginPage } from '../login/login';
import { OrderEntryPage } from '../order/orderentry';
import { GrnPage } from '../grn/grn';
import { CollectionPage } from '../collection/collection';
import { AccountledgerPage } from '../accountledger/accountledger';
import { StockdetailsPage } from '../stock/stockdetails';
import { VisitEntryPage } from '../visit/visitentry';
import { environment } from '../../app/environments/environments';
//declare var Highcharts;
//import { CompleteTestService } from '../../providers/CompleteTestService';
@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {

  @ViewChild('pieCanvas') pieCanvas;
  loading: Loading;
  divShow: boolean = false;
  pieChart: any;
  dealerlist: String;
  userid: string;
  data: any = [];
  dealerID: any;
  dealername: any;
  brandname: any;
  DeviceId: any;
  home: any = {};
  selectedData: any;
  username: any;
  status: number;
  dealers: any;
  CurrentVersion: any;
  MobileAppPath: any;
  versionNumber: any;
  visitCount: any;
  orderCount: any;
  grnCount: any;
  todaycollectionCount: any;
  monthlycollectionCount: any;

  constructor(public navCtrl: NavController, public http: Http, public loadingCtrl: LoadingController, public alertCtrl: AlertController) {

    this.userid = localStorage.getItem('userid');
    this.username = localStorage.getItem('username');
    this.CurrentVersion = localStorage.getItem('CurrentVersion');
    this.MobileAppPath = localStorage.getItem('MobileAppPath');
    // this.appVersion.getVersionNumber().then(version => {
    //   this.versionNumber = version;
    // });


  }
  getDealerIndex(val) {
    val = val.toLowerCase();
    let dealer1 = JSON.parse(localStorage.getItem('dealers'));
    let j = -1;

    for (let i = 0; dealer1.length > i; i++) {
      /* var rgxp = new RegExp(val, "gi");
      var res = dealer1[i].dealername.match(rgxp); */

      //alert('value of i:' + i);




      if (dealer1[i].dealername.toLowerCase().startsWith(val) === true) {


        j = i;
        break;
      }
    }
    return j;
  }

  onDealerFilter(val) {
    //console.log(val);
    let dealer1 = JSON.parse(localStorage.getItem('dealers'));
    //console.log(dealer1);

    let dindex = this.getDealerIndex(val);
    //alert(dindex);

    if (dindex != -1)
      this.home.selectedDealer = this.dealerlist[dindex];
    console.log(this.home.selectedDealer);

    localStorage.setItem("dealer", JSON.stringify(this.dealerlist[dindex]));
    localStorage.setItem('dealerID', dealer1[dindex].dealerid);
    localStorage.setItem('dealername', dealer1[dindex].dealername);
    localStorage.setItem('brandname', dealer1[dindex].brandname);

  }
  navigateToPage(pagename) {


    switch (pagename) {

      case 'createorder':
        this.navCtrl.push(OrderEntryPage);
        break;
      case 'visitentry':
        this.navCtrl.push(VisitEntryPage);
        break;
      case 'grnentry':
        this.navCtrl.push(GrnPage);
        break;
      case 'collection':
        this.navCtrl.push(CollectionPage);
        break;
      case 'dealerledger':
        this.navCtrl.push(AccountledgerPage);
        break;
      case 'stockdetails':
        this.navCtrl.push(StockdetailsPage);
        break;
      case 'orderlist':
        this.navCtrl.push(OrderListPage);
        break;
      case 'report':
        this.navCtrl.push(ReportPage);
        break;


    }
  }

  ngOnInit() {

    this.dealerlist = JSON.parse(localStorage.getItem('dealers'));
    this.pieChart = this.getPieChart();

    if (localStorage.getItem('dealer')) {
      this.dealername = localStorage.getItem('dealername');
      this.brandname = localStorage.getItem('brandname');

      this.divShow = true;

    }
    if (this.dealerlist === undefined || this.dealerlist === null) {
      let alert = this.alertCtrl.create({
        title: 'Message',
        message: 'Please Sync Before Use',
        buttons: [{
          text: "OK"
        },
        { text: "Cancel", }
        ]
      })
      alert.present();

    }

    this.DeviceId = localStorage.getItem('DeviceId');

  }

  /**loading chart */
  ionViewDidLoad() {


    //  this.drilldown();

  }
  /**end */
  /**dropdown item onchange event*/
  valuechange(dealervalue) {
    //console.log(dealervalue);
    if (dealervalue != null) {
      this.divShow = true;

      localStorage.setItem("dealer", JSON.stringify(dealervalue));
      localStorage.setItem('dealerID', dealervalue.dealerid);
      localStorage.setItem('dealername', dealervalue.dealername);
      localStorage.setItem('brandname', dealervalue.brandname);

    }


  }
  // drilldown() {

  //   /*Api call*/

  //   var getTotalOrderAPI = environment.apiHost + '/getTotalOrder';
  //   var getDealerVisitAPI = environment.apiHost + '/getDealerVisit';

  //   //var getDealerVisitAPI = environment.apiHost + '/visitArray';
  //   var getTotalGRNAPI = environment.apiHost + '/getTotalGRN';
  //   var getTodayCollectionAPI = environment.apiHost + '/getTodayCollection';
  //   var getMonthlyCollectionsAPI = environment.apiHost + '/getMonthlyCollections';

  //   this.http.get(getTotalOrderAPI)
  //     .subscribe(data => {
  //       this.data = JSON.parse(data['_body']);
  //       for (var i = 0; i < this.data.length; i++) {

  //         this.orderCount = this.data[i].ordercount;

  //         localStorage.setItem('orderCount', this.orderCount);

  //       }
  //     });

  //   this.http.get(getDealerVisitAPI)
  //     .subscribe(data => {
  //       this.data = JSON.parse(data['_body']);
  //       for (var i = 0; i < this.data.length; i++) {

  //         this.visitCount = this.data[i].visitcount;

  //         localStorage.setItem('visitCount', this.visitCount);

  //       }
  //     });

  //   this.http.get(getTotalGRNAPI)
  //     .subscribe(data => {
  //       this.data = JSON.parse(data['_body']);
  //       for (var i = 0; i < this.data.length; i++) {

  //         this.grnCount = this.data[i].grncount;

  //         localStorage.setItem('grnCount', this.grnCount);

  //       }
  //     });


  //   this.http.get(getTodayCollectionAPI)
  //     .subscribe(data => {
  //       this.data = JSON.parse(data['_body']);
  //       for (var i = 0; i < this.data.length; i++) {

  //         this.todaycollectionCount = this.data[i].todaycollectioncount;

  //         localStorage.setItem('todaycollectionCount', this.todaycollectionCount);

  //       }
  //     });

  //   this.http.get(getMonthlyCollectionsAPI)
  //     .subscribe(data => {
  //       this.data = JSON.parse(data['_body']);
  //       for (var i = 0; i < this.data.length; i++) {

  //         this.monthlycollectionCount = this.data[i].monthlycollectioncount;

  //         localStorage.setItem('monthlycollectionCount', this.monthlycollectionCount);

  //       }
  //     });

  //   /** api call */



  //   var visitVal = parseInt(localStorage.getItem('visitCount'));
  //   var orderVal = parseInt(localStorage.getItem('orderCount'));
  //   var grnVal = parseInt(localStorage.getItem('grnCount'));
  //   var collectionVal = parseInt(localStorage.getItem('todaycollectionCount'));





  //   Highcharts.chart('container', {
  //     chart: {
  //       plotBackgroundColor: null,
  //       plotBorderWidth: null,
  //       plotShadow: false,
  //       type: 'pie'
  //     },
  //     title: {
  //       text: 'Dashboard Chart'
  //     },
  //     tooltip: {
  //       pointFormat: '{series.name}: <b>{point.percentage:.1f}</b>'
  //     },
  //     plotOptions: {
  //       pie: {
  //         allowPointSelect: true,
  //         cursor: 'pointer',
  //         dataLabels: {
  //           enabled: false
  //         },
  //         showInLegend: true
  //       }
  //     },
  //     series: [{
  //       name: 'Count',
  //       colorByPoint: true,
  //       data: [{
  //         name: 'Total Count of Visit',
  //         y: visitVal,
  //         sliced: true,
  //         selected: true
  //       }, {
  //         name: 'Order',
  //         y: orderVal,
  //       }, {
  //         name: 'GRN',
  //         y: grnVal,
  //       }, {
  //         name: 'Collection',
  //         y: collectionVal,
  //       }]
  //     }]
  //   });
  // }
  /**logout function and clearing storage */
  logOut() {
    let alert = this.alertCtrl.create({
      title: 'Message',
      message: 'Do you want to logout',
      buttons: [{
        text: "OK",
        handler: () => {
          var myItem = localStorage.getItem('dealers');
          var myItem2 = localStorage.getItem('dealername');
          var myItem3 = localStorage.getItem('dealer');
          var myItem4 = localStorage.getItem('brandname');
          var myItem6 = localStorage.getItem('dealerID');

          localStorage.clear();
          localStorage.setItem('dealers', myItem);
          localStorage.setItem('dealername', myItem2);
          localStorage.setItem('dealer', myItem3);
          localStorage.setItem('brandname', myItem4);
          localStorage.setItem('dealerID', myItem6);

          this.navCtrl.setRoot(LoginPage);
        }
      },
      { text: "Cancel", }
      ]
    })
    alert.present();

  }
  /**This is our pie chart*/
  getPieChart() {
    var getTotalOrderAPI = environment.apiHost + '/getTotalOrder';
    var getDealerVisitAPI = environment.apiHost + '/getDealerVisit';

    //var getDealerVisitAPI = environment.apiHost + '/visitArray';
    var getTotalGRNAPI = environment.apiHost + '/getTotalGRN';
    var getTodayCollectionAPI = environment.apiHost + '/getTodayCollection';
    var getMonthlyCollectionsAPI = environment.apiHost + '/getMonthlyCollections';

    this.http.get(getTotalOrderAPI)
      .subscribe(data => {
        this.data = JSON.parse(data['_body']);
        for (var i = 0; i < this.data.length; i++) {

          this.orderCount = this.data[i].ordercount;

          localStorage.setItem('orderCount', this.orderCount);

        }
      });

    this.http.get(getDealerVisitAPI)
      .subscribe(data => {
        this.data = JSON.parse(data['_body']);
        for (var i = 0; i < this.data.length; i++) {

          this.visitCount = this.data[i].visitcount;

          localStorage.setItem('visitCount', this.visitCount);

        }
      });

    this.http.get(getTotalGRNAPI)
      .subscribe(data => {
        this.data = JSON.parse(data['_body']);
        for (var i = 0; i < this.data.length; i++) {

          this.grnCount = this.data[i].grncount;

          localStorage.setItem('grnCount', this.grnCount);

        }
      });


    this.http.get(getTodayCollectionAPI)
      .subscribe(data => {
        this.data = JSON.parse(data['_body']);
        for (var i = 0; i < this.data.length; i++) {

          this.todaycollectionCount = this.data[i].todaycollectioncount;

          localStorage.setItem('todaycollectionCount', this.todaycollectionCount);

        }
      });

    this.http.get(getMonthlyCollectionsAPI)
      .subscribe(data => {
        this.data = JSON.parse(data['_body']);
        for (var i = 0; i < this.data.length; i++) {

          this.monthlycollectionCount = this.data[i].monthlycollectioncount;

          localStorage.setItem('monthlycollectionCount', this.monthlycollectionCount);

        }
      });



    let data = {
      labels: ["Total Order", "Dealer Visit", "Total GRN", "Today's Collection", "Monthly Collections"],
      datasets: [
        {
          data: [localStorage.getItem('orderCount'), localStorage.getItem('visitCount'), localStorage.getItem('grnCount'), localStorage.getItem('todaycollectionCount'), localStorage.getItem('monthlycollectionCount')],
          backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#EEBE89", "#0612FB"],
          hoverBackgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#EEBE89", "#0612FB"]
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

  /** end of gettting our chart */
  showLoading() {
    this.loading = this.loadingCtrl.create({
      content: 'Please wait...',
      dismissOnPageChange: true
    });
    this.loading.present();
  }

  /**dealer dropdown list item */
  getDealerList() {
    var getDealerListAPI = environment.apiHost + '/getDealerList';
    var getDealerListData = JSON.stringify({ username: localStorage.getItem('username'), usergroupid: localStorage.getItem('usergroupid'), locationid: localStorage.getItem('locationid'), companyid: localStorage.getItem('companyid') });
    this.http.post(getDealerListAPI, getDealerListData)
      .subscribe(data => {

        this.data = JSON.parse(data['_body']);
		console.log(this.data);

        for (var i = 0; i < this.data.length; i++) {
          this.status = this.data[i].status;
          this.dealers = this.data[i].dealers;
        }
        // console.log(this.dealers);

        if (this.status == 1) {
          localStorage.setItem('dealers', JSON.stringify(this.dealers));
          let alert = this.alertCtrl.create({
            title: 'Message',
            message: 'Sync Complete ready to use',
            buttons: [{
              text: "OK"
            }
            ]
          })
          alert.present();

          this.navCtrl.setRoot(HomePage);
        }


      }, error => {
        console.log(error);

      });


  }
  /**end -- of function dealer dropdown list item */



}
