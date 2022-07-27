import { Component, ViewChild, NgModule, Injectable } from '@angular/core';
import { NavController, AlertController, LoadingController, Loading } from 'ionic-angular';
import { Http, Headers } from '@angular/http';
import { HomePage } from '../home/home';
import { Observable } from 'rxjs/Observable';
import { Device } from '@ionic-native/device';
import { environment } from '../../app/environments/environments';
import { ForgotpasswordPage } from './forgotpassword';
@Component({
  selector: 'page-login',
  templateUrl: 'login.html',

})
export class LoginPage {

  /** variable declaration */

  loading: Loading;
  data: any = {};
  status: number;
  username: string;
  userid: string;
  pkuserid: any;
  dealers: any;
  dealersData: any[];
  usergroupid: any = {}
  users: any = {};
  locationid: any;
  companyid: any;
  assignedBrandID: any;
  CurrentVersion: any;
  MobileAppPath: any;
  /** end of variable declaration */

  constructor(public device: Device, public navCtrl: NavController, private alertCtrl: AlertController, private loadingCtrl: LoadingController, public http: Http) {
    if (localStorage.getItem('pkuserid') != null) {
      this.navCtrl.setRoot(HomePage);
    }
    // console.log(localStorage.getItem('pkuserid'));
  }
  /** login method */
  signIn() {

    this.showLoading();

    var checkloginAPI = environment.apiHost + '/checklogin';
    var checkloginData = JSON.stringify({ username: this.data.username, password: this.data.password, deviceID: this.device.uuid });

    if ((this.data.username != null) && (this.data.password != null)) {

      this.http.post(checkloginAPI, checkloginData)
        .subscribe(data => {

          this.data = JSON.parse(data['_body']);
          //console.log(this.data);
          for (var i = 0; i < this.data.length; i++) {
            this.status = this.data[i].status;
            this.username = this.data[i].username;
            this.userid = this.data[i].userid;
            this.pkuserid = this.data[i].pkuserid;
            this.dealers = this.data[i].dealers;
            this.usergroupid = this.data[i].usergroupid;
            this.locationid = this.data[i].locationid;
            this.companyid = this.data[i].companyid;
            this.assignedBrandID = this.data[i].assignedBrandID;
            this.users = this.data[i].users;
            this.CurrentVersion = this.data[i].CurrentVersion;
            this.MobileAppPath = this.data[i].MobileAppPath;
          }

          if (this.status == 1) {
            if (this.usergroupid == 1) {

              localStorage.setItem('users', JSON.stringify(this.users));
              console.log(this.users);
            }
            localStorage.setItem('username', this.username);
            localStorage.setItem('userid', this.userid);
            localStorage.setItem('pkuserid', this.pkuserid);
            localStorage.setItem('usergroupid', this.usergroupid);
            localStorage.setItem('locationid', this.locationid);
            localStorage.setItem('companyid', this.companyid);
            localStorage.setItem('assignedBrandID', this.assignedBrandID);
            localStorage.setItem('CurrentVersion', this.CurrentVersion);
            localStorage.setItem('MobileAppPath', this.MobileAppPath);
            this.navCtrl.setRoot(HomePage);

          }

          else {

            if (this.status == 2) {
              this.loading.dismiss();
              let alert = this.alertCtrl.create({
                title: 'Fail',
                message: 'Another User already Registered with this device',
                buttons: [{
                  text: "OK"
                }]
              })
              alert.present();

            }
            else {
              this.loading.dismiss();
              let alert = this.alertCtrl.create({
                title: 'Fail',
                message: 'Please Enter Valid Username and Password',
                buttons: [{
                  text: "OK"
                }]
              })
              alert.present();

            }
            this.navCtrl.push(LoginPage);
          }



        }, error => {
          this.loading.dismiss();
          let alert = this.alertCtrl.create({
            title: 'Fail',
            message: error,
            buttons: [{
              text: "OK",
              handler: () => { this.navCtrl.setRoot(LoginPage); }
            }]
          })
          alert.present();
          this.navCtrl.push(LoginPage);
        });

      if (this.device.uuid) {
        localStorage.setItem('DeviceId', this.device.uuid);

      }

    }
    else {
      this.showError('Please Enter Username and Password');
    }
  }
  /**end -- login method*/

  /**loader */
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

  forgotPassword() {
    console.log("inside ForgotpasswordPage");
    this.navCtrl.push(ForgotpasswordPage);
  }

}
