import { Component } from '@angular/core';
import { IonicPage, NavController, AlertController, ModalController, ViewController, NavParams } from 'ionic-angular';
import { RejectlistPage } from '../grn/rejectlist';
import { Http } from '@angular/http';
import { HomePage } from '../home/home';
import { environment } from '../../app/environments/environments';
import { DatePipe } from '@angular/common';
import { FormGroup, FormBuilder, Validators, FormControl } from '@angular/forms';

@IonicPage()
@Component({
  selector: 'page-grn',
  templateUrl: 'grn.html',
})
export class GrnPage {
  grnlist: any = [];
  myDate: Date = new Date();
  product: any;
  newDate: any;
  inVoiceNumber: any;
  dealerID: any;
  dealername: any;
  brandname: any;
  pkuserid: any;
  deviceid: any;
  response: any;
  status: any;
  modalData: any;
  grndata: any;
  grn: any = {};
  grnNo: any;
  grninvoicenumber: any;
  grnnumber: any;
  cart: Array<{}> = [];
  item: any = [];
  invoicedate: String = new Date().toISOString();
  grninvoicedate: String;
  signupform: FormGroup;
  // data: Array<{ productid: number, productname: string, feedback: string, defect: string, quantity: string, categoryId: string, categoryname: string, icon: string, showDetails: boolean }> = [];
  constructor(public http: Http, public datePipe: DatePipe, public viewCtrl: ViewController, public navCtrl: NavController, public alertCtrl: AlertController, public modalCtrl: ModalController, public navParams: NavParams) {
    this.product = navParams.get('data');


  }
  gotohomepage() {
    this.cart = [];
    localStorage.removeItem("cartitem");
    this.navCtrl.setRoot(HomePage);
  }
  ngOnInit() {
    if (localStorage.getItem('grninvoicedate') != null) {
      this.grn.invoicedate = localStorage.getItem('grninvoicedate');

      let EMAILPATTERN = /^[a-z0-9!#$%&'*+\/=?^_`{|}~.-]+@[a-z0-9]([a-z0-9-]*[a-z0-9])?(\.[a-z0-9]([a-z0-9-]*[a-z0-9])?)*$/i;
      this.signupform = new FormGroup({
        username: new FormControl('', [Validators.required, Validators.pattern('[a-zA-Z ]*'), Validators.minLength(4), Validators.maxLength(10)]),
        password: new FormControl('', [Validators.required, Validators.minLength(6), Validators.maxLength(12)]),
        name: new FormControl('', [Validators.required, Validators.pattern('[a-zA-Z ]*'), Validators.minLength(4), Validators.maxLength(30)]),
        email: new FormControl('', [Validators.required, Validators.pattern(EMAILPATTERN)]),
      });



    }
    else {
      this.grn.invoicedate = this.invoicedate;
    }
    console.log(this.grn.invoicedate);
    if (localStorage.getItem('grninvoicenumber') != null) {
      this.grn.inVoiceNumber = localStorage.getItem('grninvoicenumber');

    }
    else {
      this.grn.inVoiceNumber = 0;
    }

    this.newDate = this.myDate.getFullYear() + '-' + ('' + (this.myDate.getFullYear() + 1)).slice(-2);
    this.grnNo = this.newDate + "/GRN/" + this.randomString(4, "N");
    this.dealerID = localStorage.getItem('dealerID');
    this.dealername = localStorage.getItem('dealername');
    this.brandname = localStorage.getItem('brandname');
    this.pkuserid = localStorage.getItem('pkuserid');
    this.deviceid = localStorage.getItem('DeviceId');

    this.item = JSON.parse(localStorage.getItem('cartitem'));
    console.log('previous item', this.item);

    if (localStorage.getItem('cartitem') != null) {
      for (let i = 0; i < this.item.length; i++) {


        this.cart.push({
          productid: this.item[i].productid,
          productname: this.item[i].productname,
          feedback: "",
          defect: this.item[i].defect,
          quantity: this.item[i].quantity,
          categoryId: this.item[i].categoryId,
          categoryname: this.item[i].categoryname,
          icon: 'ios-remove-circle-outline',
          showDetails: true
        });

      }

    }


    if (this.product) {
      this.grnlist = JSON.parse(this.product.rejectdata);

      for (let i = 0; i < this.grnlist.length; i++) {

        if (this.grnlist[i].quantity != 0) {
          this.cart.push({
            productid: this.grnlist[i].productid,
            productname: this.grnlist[i].productname,
            feedback: "",
            defect: this.grnlist[i].defect,
            quantity: this.grnlist[i].quantity,
            categoryId: this.grnlist[i].categoryId,
            categoryname: this.grnlist[i].categoryname,
            icon: 'ios-remove-circle-outline',
            showDetails: true
          });
        }
      }
      console.log('added item', this.cart);

    }




  }

  /*===== create random string for grn number ===== */
  randomString(len, an) {
    an = an && an.toLowerCase();
    var str = "", i = 0, min = an == "a" ? 10 : 0, max = an == "n" ? 10 : 62;
    for (; i++ < len;) {
      var r = Math.random() * (max - min) + min << 0;
      str += String.fromCharCode(r += r > 9 ? r < 36 ? 55 : 61 : 48);
    }
    return str;
  }
  /*===== end ===== */

  gotorejectlispage(dataval) {
    if (dataval.length != 0) {
      localStorage.setItem('cartitem', JSON.stringify(dataval));
    }
    if (this.grn.inVoiceNumber) {
      localStorage.setItem('grninvoicenumber', this.grn.inVoiceNumber);
    }
    if (this.grn.invoicedate) {
      localStorage.setItem('grninvoicedate', this.grn.invoicedate);
    }
    this.navCtrl.push(RejectlistPage);

  }

  /*===== submit grn =====*/

  dataSaved(grnlist) {
    this.grninvoicedate = this.datePipe.transform(this.grn.invoicedate, 'yyyy-MM-dd');
    var obj1 = { createdby: this.pkuserid, InvoiceNo: this.grn.inVoiceNumber, InvoiceDate: this.grninvoicedate, grnNo: this.grnNo, dealerid: this.dealerID, DeviceID: this.deviceid, location: 'kolkata' };
    var obj2 = this.modalData;
    var obj3 = { grnlist };
    var mergedData = Object.assign(obj1, obj2, obj3);
    var saveGrnDetailsAPI = environment.apiHost + '/saveGrnDetails';
    var saveGrnDetailsData = JSON.stringify(mergedData);

    this.http.post(saveGrnDetailsAPI, saveGrnDetailsData)
      .subscribe(data => {

        this.response = JSON.parse(data['_body']);
        for (var i = 0; i < this.response.length; i++) {
          this.status = this.response[i].status;
          this.grnnumber = this.response[i].grnNo;
        }

        if (this.status == 1) {
          let alert = this.alertCtrl.create({
            title: 'Confirm',
            subTitle: '<p>GRN saved successfully.</p><p> Your GRN No:' + this.grnnumber + '</p>',
            buttons: ['OK']
          });
          alert.present();
          this.cart = [];
          localStorage.removeItem("cartitem");
          localStorage.removeItem("grninvoicenumber");
          this.navCtrl.setRoot(GrnPage);
        }
      }, error => {
        console.log(error);

      });


  }

  /*=== end ===*/


  /*=====  toggle for feedback ===== */
  toggleDetails(data) {
    if (data.showDetails) {
      data.showDetails = false;
      data.icon = 'ios-add-circle-outline';
    } else {
      data.showDetails = true;
      data.icon = 'ios-remove-circle-outline';
    }
  }
  /*=== end === */

  dataDeleted() {
    let alert = this.alertCtrl.create({
      title: 'Message',
      subTitle: 'Data deleted successfully',
      buttons: ['Ok']
    });
    alert.present();

  }
  dataCancel() {
    this.navCtrl.setRoot(HomePage);
  }




}
