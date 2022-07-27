import { Component, ViewChild, NgModule, Injectable } from '@angular/core';
import { NavController, AlertController, LoadingController, Loading } from 'ionic-angular';
import { Http, Headers } from '@angular/http';
import { HomePage } from '../home/home';
import { Observable } from 'rxjs/Observable';
import { Device } from '@ionic-native/device';
import { environment } from '../../app/environments/environments';
import { ResetpasswordPage } from './resetpassword';
@Component({
  selector: 'page-forgotpassword',
  templateUrl: 'forgotpassword.html',

})
export class ForgotpasswordPage {

  /** variable declaration */

  loading: Loading;
  data: any = {};
  status: number;
  item: any;
  /** end of variable declaration */

  constructor(public device: Device, public navCtrl: NavController, private alertCtrl: AlertController, private loadingCtrl: LoadingController, public http: Http) {
    if (localStorage.getItem('pkuserid') != null) {
      this.navCtrl.setRoot(HomePage);
    }

  }

  showLoading() {
    this.loading = this.loadingCtrl.create({
      content: 'Please wait...',
      dismissOnPageChange: true
    });
    this.loading.present();
  }

  showError(text) {
    this.loading.dismiss();

    let alert = this.alertCtrl.create({
      title: 'Login Failed',
      subTitle: text,
      buttons: ['OK']
    });
    alert.present();
  }
  generateOTP() {
    var getGenerateOTPAPI = environment.apiHost + '/getGenerateOTP';
    var getGenerateOTPData = JSON.stringify({ username: this.data.username, email: this.data.email });
    console.log(getGenerateOTPData);
    this.http.post(getGenerateOTPAPI, getGenerateOTPData)
      .subscribe(data => {
        console.log(data['_body']);
        this.item = JSON.parse(data['_body'])

        for (var a = 0; a < this.item.length; a++) {
          this.status = this.item[a].status;
          if (this.status == 1) {
            this.navCtrl.push(ResetpasswordPage);
          }
        }

      }, error => {
        console.log(error);

      });
  }


}
