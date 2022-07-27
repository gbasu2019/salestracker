import { Component, ViewChild } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { VisitListPage } from '../visit/visitlist';
import { GrnviewPage } from '../grn/grnview';
import { CollectionlistPage } from '../collection/collectionlist';
import { environment } from '../../app/environments/environments';
import { HomePage } from '../home/home';
import { OrderListPage } from '../order/orderlist';
import { Chart } from 'chart.js';
import { Http, Headers } from '@angular/http';
@Component({

  templateUrl: 'reportpage.html',

})

export class ReportPage {
  @ViewChild('pieCanvas') pieCanvas;
  visitCount: any;
  orderCount: any;
  grnCount: any;
  todaycollectionCount: any;
  monthlycollectionCount: any;
  data: any;
  pieChart: any;
  constructor(public navCtrl: NavController, public http: Http) {
  }
  ionViewDidLoad() {

    this.pieChart = this.getPieChart();

  }
  getPieChart() {
    var getTotalOrderAPI = environment.apiHost + '/getTotalOrder';
    var getDealerVisitAPI = environment.apiHost + '/getDealerVisit';
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



    this.http.get(getMonthlyCollectionsAPI)
      .subscribe(data => {
        this.data = JSON.parse(data['_body']);
        for (var i = 0; i < this.data.length; i++) {

          this.monthlycollectionCount = this.data[i].monthlycollectioncount;
          localStorage.setItem('monthlycollectionCount', this.monthlycollectionCount);

        }
      });
    console.log(localStorage.getItem('orderCount'));
    console.log(localStorage.getItem('visitCount'));
    console.log(localStorage.getItem('monthlycollectionCount'));

    let data = {
      labels: ["No of Order", "Visit", "Collection amount"],
      datasets: [
        {
          data: [localStorage.getItem('orderCount'), localStorage.getItem('visitCount'), localStorage.getItem('monthlycollectionCount')],
          backgroundColor: ["#FF6384", "#36A2EB", "#0612FB"],
          hoverBackgroundColor: ["#FF6384", "#36A2EB", "#0612FB"]
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
  visitlist() {
    this.navCtrl.push(VisitListPage);

  }
  grnlist() {
    this.navCtrl.push(GrnviewPage);
  }
  collectionlist() {
    this.navCtrl.push(CollectionlistPage);
  }
  home() {

    this.navCtrl.push(HomePage);
  }
  orderList() {
    this.navCtrl.push(OrderListPage);
  }
  gotohomepage() {
    this.navCtrl.setRoot(HomePage);
  }
}