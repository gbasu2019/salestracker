import { Component, ViewChild } from '@angular/core';
import { NavController, NavParams, PopoverController, IonicPage, ModalController, AlertController } from 'ionic-angular';
import { Http } from '@angular/http';
import { DatePipe } from '@angular/common';
import { HomePage } from '../home/home';
import { environment } from '../../app/environments/environments';
import { ImageViewerController } from "ionic-img-viewer";
import { Chart } from 'chart.js';
let getVisitListAPI = environment.apiHost + '/getVisitList';
@Component({

  templateUrl: 'visitlist.html',

})

export class VisitListPage {
  @ViewChild('barCanvas') barCanvas;
  barChart: any;
  dealername: any;
  brandname: any;
  search: any = {};
  startDate: String;
  endDate: String = new Date().toISOString();
  date: Date;
  date2: Date;
  item: any = {};
  orders: any = {};
  hide: boolean = false;
  visitlist: any = {};
  visitdata: any = [];
  status: any;
  setStatrtDob: string;
  setEndrtDob: string;
  dealerlist: String;
  users: any = {};
  usergrpId: any;
  data: any = [];
  dataval: any;
  visitCount: any;
  visitCount2: any;
  visitCount3: any;
  enddateVal: any;
  constructor(public alertCtrl: AlertController, public http: Http, public datePipe: DatePipe, public navCtril: NavController, public imageViewerCtrl: ImageViewerController) {

    if (localStorage.getItem('users')) {
      this.users = JSON.parse(localStorage.getItem('users'));
    }
    else {
      this.users = '';
    }

  }

  ionViewDidLoad() {

    this.barChart = this.getBarChart();

  }
  getChart(context, chartType, data, options?) {
    return new Chart(context, {
      type: chartType,
      data: data,
      options: options
    });
  }
  getBarChart() {

    var visitArrayAPI = environment.apiHost + '/visitArray';
    var visitArrayApprovedAPI = environment.apiHost + '/visitArrayApproved';
    var visitArrayRejectedAPI = environment.apiHost + '/visitArrayRejected';

    this.http.get(visitArrayAPI)
      .subscribe(data => {
        this.dataval = JSON.parse(data['_body']);

        for (var i = 0; i < this.dataval.length; i++) {

          this.visitCount = this.dataval[i].visitcount;

          localStorage.setItem('visitCount', this.visitCount);

        }

      });
    this.http.get(visitArrayApprovedAPI)
      .subscribe(data => {
        this.dataval = JSON.parse(data['_body']);

        for (var i = 0; i < this.dataval.length; i++) {

          this.visitCount3 = this.dataval[i].visitcount;

          localStorage.setItem('visitCountApproved', this.visitCount3);

        }

      });
    this.http.get(visitArrayRejectedAPI)
      .subscribe(data => {
        this.dataval = JSON.parse(data['_body']);

        for (var i = 0; i < this.dataval.length; i++) {

          this.visitCount2 = this.dataval[i].visitcount;

          localStorage.setItem('visitCountRejected', this.visitCount2);

        }

      });

    console.log(localStorage.getItem('visitCount'));
    console.log(localStorage.getItem('visitCountApproved'));
    console.log(localStorage.getItem('visitCountRejected'));


    let data = {
      labels: ["Total Visit", "Approved", "Rejected"],
      datasets: [{
        label: 'No of Visit',
        data: [localStorage.getItem('visitCount'), localStorage.getItem('visitCountApproved'), localStorage.getItem('visitCountRejected')],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(244, 164, 96, 0.8)',
          'rgba(54, 162, 235, 0.2)'
        ],
        borderColor: [
          'rgba(255,99,132,1)',
          'rgba(244, 164, 96, 1)',
          'rgba(54, 162, 235, 1)'
        ],
        borderWidth: 1
      }]
    };

    let options = {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }

    return this.getChart(this.barCanvas.nativeElement, "bar", data, options);
  }
  /**==populate the list when page load== */
  ngOnInit() {

    this.dealerlist = JSON.parse(localStorage.getItem('dealers'));
    this.date = new Date();
    //console.log(this.date);
    this.search.endDate = this.endDate;
    this.search.startDate = new Date(this.date.getTime() - 3 * 24 * 60 * 60 * 1000).toISOString();
    this.setStatrtDob = this.datePipe.transform(this.search.startDate, 'yyyy-MM-dd');
    this.setEndrtDob = this.datePipe.transform(this.search.endDate, 'yyyy-MM-dd');
    this.usergrpId = localStorage.getItem('usergroupid');
    this.brandname = localStorage.getItem('brandname');


    if (localStorage.getItem('usergroupid') == '1') {
      var getVisitListData = JSON.stringify({ userid: 0, usergroupid: localStorage.getItem('usergroupid'), dealerid: this.search.selectedDealer, startDate: this.setStatrtDob, endDate: this.setEndrtDob });
    }
    else {
      var getVisitListData = JSON.stringify({ userid: localStorage.getItem('pkuserid'), usergroupid: localStorage.getItem('usergroupid'), dealerid: this.search.selectedDealer, startDate: this.setStatrtDob, endDate: this.setEndrtDob });
    }

    this.generateVisitList(getVisitListAPI, getVisitListData);


  }
  goToSlide() {

    var lastVisitDateAPI = environment.apiHost + '/lastVisitDate';

    this.http.get(lastVisitDateAPI)
      .subscribe(data => {
        this.dataval = JSON.parse(data['_body']);

        for (var i = 0; i < this.dataval.length; i++) {

          this.enddateVal = this.dataval[i].enddate;

          localStorage.setItem('enddateVal', this.enddateVal);

        }

      });




    this.date2 = new Date(this.search.endDate);
    console.log(this.date);
    this.search.endDate = localStorage.getItem('enddateVal');



    this.search.startDate = new Date(this.date2.getTime() - 7 * 24 * 60 * 60 * 1000).toISOString();

    //this.search.startDate = new Date((this.search.endDate).getTime() - 7 * 24 * 60 * 60 * 1000).toISOString();
    this.setStatrtDob = this.datePipe.transform(this.search.startDate, 'yyyy-MM-dd');
    this.setEndrtDob = this.datePipe.transform(this.search.endDate, 'yyyy-MM-dd');

    if (!this.search.selectedDealer) {
      this.search.selectedDealer = 0;
    }

    this.setStatrtDob = this.datePipe.transform(this.search.startDate, 'yyyy-MM-dd');
    var getVisitListData = JSON.stringify({ userid: localStorage.getItem('pkuserid'), usergroupid: localStorage.getItem('usergroupid'), dealerid: this.search.selectedDealer, startDate: this.setStatrtDob, endDate: this.setEndrtDob });
    this.generateVisitList(getVisitListAPI, getVisitListData);
  }

  /**==== toggle filter section ==== */
  ngIfCtrl() {
    this.hide = !this.hide;
  }
  /**===reset button function call==== */
  ResetData() {
    this.navCtril.push(VisitListPage);
  }
  /**====== Search result ======== */
  SearchData() {
    this.dealername = '';
    this.setStatrtDob = this.datePipe.transform(this.search.startDate, 'yyyy-MM-dd');
    this.setEndrtDob = this.datePipe.transform(this.search.endDate, 'yyyy-MM-dd');


    if (localStorage.getItem('usergroupid') == '1') {
      if (!this.search.user) {
        this.search.user = 0

      }

      var getVisitListData = JSON.stringify({ userid: this.search.user, usergroupid: localStorage.getItem('usergroupid'), dealerid: this.search.selectedDealer, startDate: this.setStatrtDob, endDate: this.setEndrtDob });
    }
    else {
      var getVisitListData = JSON.stringify({ userid: localStorage.getItem('pkuserid'), usergroupid: localStorage.getItem('usergroupid'), dealerid: this.search.selectedDealer, startDate: this.setStatrtDob, endDate: this.setEndrtDob });
    }

    this.generateVisitList(getVisitListAPI, getVisitListData);

  }
  /**===== end ====== */

  gotohomepage() {
    this.navCtril.setRoot(HomePage);
  }
  /** ======= common function for generate orderlist function for listing visit ===== */
  generateVisitList(getVisitListAPI, getVisitListData) {
    this.http.post(getVisitListAPI, getVisitListData)
      .subscribe(data => {

        this.data.length = 0;
        this.item = JSON.parse(data['_body'])



        for (var k = 0; k < this.item.length; k++) {
          this.visitlist = this.item[k].visitlist;
          this.status = this.item[k].status;

          for (var i = 0; i < this.visitlist.length; i++) {
            this.visitdata = this.visitlist[i].visitlist;
            this.status = this.visitlist[i].status;
            if (this.status == 1) {
              for (let i = 0; i < this.visitdata.length; i++) {

                if (this.visitdata[i].VisitImage != "") {
                  this.data.push({
                    VisitID: this.visitdata[i].VisitID,
                    FullName: this.visitdata[i].FullName,
                    City: this.visitdata[i].City,
                    Country: this.visitdata[i].Country,
                    Latitude: this.visitdata[i].Latitude,
                    Location: this.visitdata[i].Location,
                    Longitude: this.visitdata[i].Longitude,
                    State: this.visitdata[i].State,
                    VisitDate: this.visitdata[i].VisitDate,
                    VisitStatus: this.visitdata[i].VisitStatus,
                    VisitImage: environment.apiHost + "/" + this.visitdata[i].VisitImage,
                    DealerName: this.visitdata[i].DealerName,
                    icon: 'ios-add-circle-outline',
                    showDetails: false
                  });
                }
                else {

                }

                this.data.push({
                  VisitID: this.visitdata[i].VisitID,
                  FullName: this.visitdata[i].FullName,
                  City: this.visitdata[i].City,
                  Country: this.visitdata[i].Country,
                  Latitude: this.visitdata[i].Latitude,
                  Location: this.visitdata[i].Location,
                  Longitude: this.visitdata[i].Longitude,
                  State: this.visitdata[i].State,
                  VisitDate: this.visitdata[i].VisitDate,
                  VisitStatus: this.visitdata[i].VisitStatus,
                  VisitImage: "",
                  DealerName: this.visitdata[i].DealerName,
                  icon: 'ios-add-circle-outline',
                  showDetails: false
                });
              }

            }


          }
        }
        // console.log(this.data);

      }, error => {
        console.log(error);

      });
  }
  Reject(visitVal) {
    console.log(visitVal);
    var updateVisitData = JSON.stringify({ VisitID: visitVal.VisitID, VisitStatus: 'Reject' });
    var updateVisitAPI = environment.apiHost + '/updateVisit';
    this.http.post(updateVisitAPI, updateVisitData)
      .subscribe(data => {
        this.item = JSON.parse(data['_body'])
        for (var k = 0; k < this.item.length; k++) {
          this.status = this.item[k].status;
          console.log(this.status);
          if (this.status == 1) {
            let alert = this.alertCtrl.create({
              title: 'Confirm',
              subTitle: 'Status Update succesfully',
              buttons: ['OK']
            });
            alert.present();
            this.navCtril.push(VisitListPage);
          }
        }

      }, error => {
        console.log(error);

      });

  }
  Approval(visitVal) {
    console.log(visitVal);
    var updateVisitData = JSON.stringify({ VisitID: visitVal.VisitID, VisitStatus: 'Approved' });
    var updateVisitAPI = environment.apiHost + '/updateVisit';
    this.http.post(updateVisitAPI, updateVisitData)
      .subscribe(data => {
        this.item = JSON.parse(data['_body'])
        for (var k = 0; k < this.item.length; k++) {
          this.status = this.item[k].status;
          console.log(this.status);
          if (this.status == 1) {
            let alert = this.alertCtrl.create({
              title: 'Confirm',
              subTitle: 'Status Update succesfully',
              buttons: ['OK']
            });
            alert.present();
            this.navCtril.push(VisitListPage);
          }
        }
      }, error => {
        console.log(error);

      });
  }
}

