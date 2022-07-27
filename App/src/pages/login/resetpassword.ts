import { Component, ViewChild, NgModule, Injectable } from '@angular/core';
import { NavController, AlertController, LoadingController, Loading } from 'ionic-angular';
import { Http, Headers } from '@angular/http';
import { HomePage } from '../home/home';
import { Observable } from 'rxjs/Observable';
import { Device } from '@ionic-native/device';
import { environment } from '../../app/environments/environments';
import { LoginPage } from './login';
@Component({
  selector: 'page-forgotpassword',
  templateUrl: 'resetpassword.html',

})
export class ResetpasswordPage {

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
  resetPassword() {
    var getresetPasswordAPI = environment.apiHost + '/getresetPassword';
    var getresetPasswordData = JSON.stringify({ code: this.data.validationCode });
    console.log(getresetPasswordData);
    this.http.post(getresetPasswordAPI, getresetPasswordData)
      .subscribe(data => {
        console.log(data['_body']);
        this.item = JSON.parse(data['_body'])

        for (var a = 0; a < this.item.length; a++) {
          this.status = this.item[a].status;
          // if (this.status == 1) {
          this.navCtrl.push(LoginPage);
          // }
        }

      }, error => {
        console.log(error);

      });
  }


}
