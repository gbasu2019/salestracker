import { Component } from '@angular/core';
import { LoadingController, IonicPage, NavController, NavParams, Loading } from 'ionic-angular';
import { Http } from '@angular/http';
import { DatePipe } from '@angular/common';
import { environment } from '../../app/environments/environments';
@IonicPage()
@Component({
  selector: 'page-accountledger',
  templateUrl: 'accountledger.html',
})
export class AccountledgerPage {
  loading: Loading;
  ledgerdata: any = [];
  //startDate: String = new Date().toISOString();
  // endDate: String;
  endDate: String = new Date().toISOString();
  startDate: String;
  date: Date;
  item: any = [];
  status: any;
  setStatrtDob: string;
  setEndrtDob: string;
  dealername: string;
  constructor(public http: Http, public navCtrl: NavController, public loadingCtrl: LoadingController, public navParams: NavParams, public datePipe: DatePipe) {


  }

  ngOnInit() {
    this.dealername = localStorage.getItem('dealername');
    this.date = new Date();
    this.startDate = new Date(this.date.getTime() - 30 * 24 * 60 * 60 * 1000).toISOString();
    this.setStatrtDob = this.datePipe.transform(this.startDate, 'yyyy-MM-dd');
    this.setEndrtDob = this.datePipe.transform(this.endDate, 'yyyy-MM-dd');
    var getLedgerlistAPI = environment.apiHost + '/getLedgerlist';
    var getLedgerlistData = JSON.stringify({ dealerid: localStorage.getItem('dealerID'), startDate: this.setStatrtDob, endDate: this.setEndrtDob });
    this.generateledgerlist(getLedgerlistAPI, getLedgerlistData);
    console.log(localStorage.getItem('dealerID'));

  }
  SearchData() {


    this.setStatrtDob = this.datePipe.transform(this.startDate, 'yyyy-MM-dd');
    this.setEndrtDob = this.datePipe.transform(this.endDate, 'yyyy-MM-dd');

    var getLedgerlistAPI = environment.apiHost + '/getLedgerlist';
    var getLedgerlistData = JSON.stringify({ dealerid: localStorage.getItem('dealerID'), startDate: this.setStatrtDob, endDate: this.setEndrtDob });

    this.generateledgerlist(getLedgerlistAPI, getLedgerlistData);


  }

  generateledgerlist(getLedgerlistAPI, getLedgerlistData) {
    this.showLoading();
    console.log(getLedgerlistData);
    this.http.post(getLedgerlistAPI, getLedgerlistData)
      .subscribe(data => {

        this.item = JSON.parse(data['_body'])

        this.ledgerdata.length = 0;
        for (var k = 0; k < this.item.length; k++) {
          this.ledgerdata = this.item[k].Ledgerlist;
          this.status = this.item[k].status;

          if (this.status == 1) {
            this.loading.dismiss();
          }
        }
        //console.log(this.status);



      }, error => {
        //console.log(error);

      });
  }
  showLoading() {
    this.loading = this.loadingCtrl.create({
      content: 'Please wait...',
      dismissOnPageChange: true
    });
    this.loading.present();
  }
}
