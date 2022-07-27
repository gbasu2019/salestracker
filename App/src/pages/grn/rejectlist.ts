import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, AlertController } from 'ionic-angular';
import { HomePage } from '../home/home';
import { GrnPage } from './grn';
import { Http } from '@angular/http';
import { environment } from '../../app/environments/environments';
@IonicPage()
@Component({
  selector: 'page-reject',
  templateUrl: 'rejectlist.html',
})
export class RejectlistPage {
  rejectdata: any[]
  assignedBrandID: string;
  categorylists: any[];
  subcategorylists: any;
  subsubcategorylists: any;
  selectedsubcategories: any;
  result: any = {};
  status: any;
  itemlist: any;
  itemliststatus: any;
  subcategorystatus: any;
  nextsubcategorylists: any;
  categoryID: any;
  data: any = {};

  public buttonClicked: boolean = false;
  constructor(public navCtrl: NavController, public alertCtrl: AlertController, public http: Http) {

    /*======== category dropdownlist populate =========*/
    this.assignedBrandID = localStorage.getItem('assignedBrandID');
    var getGrnCategoryDropdownListAPI = environment.apiHost + '/getGrnCategoryDropdownListNew';
    var getGrnCategoryDropdownListData = JSON.stringify({ assignedBrandID: this.assignedBrandID,DealerID:localStorage.getItem('dealerID')});

    this.http.post(getGrnCategoryDropdownListAPI, getGrnCategoryDropdownListData)
      .subscribe(data => {
        this.categorylists = JSON.parse(data['_body']);
        this.data.subcategoryid = 0;
        this.data.subsubcategoryid = 0;
        this.data.categoryid = 0;

      }, error => {
        console.log(error);
      });
    /*======== end --- category dropdownlist populate function ========*/
  }

  /*======== 1st Sub category dropdownlist populate =========*/
  setSubcategoryValues(scategoryid) {


    this.subcategorylists = 0;
    var getGrnSubCategoryDropdownListAPI = environment.apiHost + '/getGrnSubCategoryDropdownList';
    var getGrnSubCategoryDropdownListData = JSON.stringify({ parentcategoryid: scategoryid });

    this.http.post(getGrnSubCategoryDropdownListAPI, getGrnSubCategoryDropdownListData)
      .subscribe(data => {
        this.result = JSON.parse(data['_body']);
        if (this.result.status == 1) {
          this.subcategorylists = this.result.productarray;
          this.subsubcategorylists = 0;
          this.nextsubcategorylists = 0;
          this.itemlist = 0;
          this.data.subcategoryid = 0;
          this.data.subsubcategoryid = 0;
          this.data.categoryid = 0;
        }

        if (this.result.status == 2) {
          this.nextsubcategorylists = 0;
          this.subsubcategorylists = 0;
          this.itemlist = this.result.productarray;


        }
        if (this.result.status == 0) {
          this.subsubcategorylists = 0;
          this.nextsubcategorylists = 0;
          this.itemlist = 0;
          this.data.subcategoryid = 0;
          this.data.subsubcategoryid = 0;
          this.data.categoryid = 0;
          let alert = this.alertCtrl.create({
            title: 'Message',
            subTitle: '<p>No Item Found</p>',
            buttons: ['OK']
          });
          alert.present();
        }



      }, error => {
        console.log(error);
      });

  }

  /*======== end --- 1st Sub category dropdownlist populate function ========*/

  /*========= 2nd Sub category dropdownlist populate ==========*/
  setSubsubcategoryValues(sscategoryid) {

    this.subsubcategorylists = 0;
    var getGrnSubCategoryDropdownListAPI = environment.apiHost + '/getGrnSubCategoryDropdownList';
    var getGrnSubCategoryDropdownListData = JSON.stringify({ parentcategoryid: sscategoryid });

    this.http.post(getGrnSubCategoryDropdownListAPI, getGrnSubCategoryDropdownListData)
      .subscribe(data => {

        this.result = JSON.parse(data['_body']);


        if (this.result.status == 1) {

          this.subsubcategorylists = this.result.productarray;
          this.nextsubcategorylists = 0;
          this.itemlist = 0;
          this.data.subsubcategoryid = 0;
          this.data.categoryid = 0;
        }
        if (this.result.status == 2) {
          this.nextsubcategorylists = 0;
          this.itemlist = this.result.productarray;

        }
        if (this.result.status == 0) {
          this.nextsubcategorylists = 0;
          this.itemlist = 0;
          this.data.subsubcategoryid = 0;
          this.data.categoryid = 0;
          let alert = this.alertCtrl.create({
            title: 'Message',
            subTitle: '<p>No Item Found</p>',
            buttons: ['OK']
          });
          alert.present();
        }


      }, error => {
        console.log(error);
      });

  }

  /*========= 3rd Sub category  dropdownlist or itemlist populate ==========*/
  setitemcategoryValues(categoryid) {

    var getGrnSubCategoryDropdownListAPI = environment.apiHost + '/getGrnSubCategoryDropdownList';
    var getGrnSubCategoryDropdownListData = JSON.stringify({ parentcategoryid: categoryid });
    this.http.post(getGrnSubCategoryDropdownListAPI, getGrnSubCategoryDropdownListData)
      .subscribe(data => {
        this.result = JSON.parse(data['_body']);

        if (this.result.status == 1) {
          this.nextsubcategorylists = this.result.productarray;
          this.itemlist = 0;
          if (this.nextsubcategorylists.length == 1) {
            this.data.categoryid = 0
          }
        }
        if (this.result.status == 2) {
          this.itemlist = this.result.productarray;
          this.categoryID = this.result.lastCategoryID;

        }
        if (this.result.status == 0) {
          this.itemlist = 0;
          let alert = this.alertCtrl.create({
            title: 'Message',
            subTitle: '<p>No Item Found</p>',
            buttons: ['OK']
          });
          alert.present();
        }


      }, error => {
        console.log(error);
      });

  }

  gotoDashBoard() {
    this.navCtrl.setRoot(HomePage)
  }
  /*====== plus minus button function ======= */
  private increment(rejectlist) {
    rejectlist.quantity++;

  }

  private decrement(rejectlist) {
    if (rejectlist.quantity > 0) {
      rejectlist.quantity--;
    }

  }
  /*=====end --- plus minus button function ====== */

  /*===== add product for GRN ===== */
  formSubmit(rejectdata) {
    var flag = 0;
    var rejectlist = JSON.stringify(rejectdata);
    var obj1 = { rejectdata: rejectlist };
    var obj2 = this.data;
    var mergedData = Object.assign(obj1, obj2);
    for (var j = 0; j < rejectdata.length; j++) {

      if ((rejectdata[j].quantity != 0)) {
        flag = 1;
      }
    }
    if (flag == 1) {
      this.navCtrl.push(GrnPage, {
        data: mergedData
      });
    }

    else {
      let alert = this.alertCtrl.create({
        title: 'Message',
        subTitle: '<p>Please add  product to continue</p>',
        buttons: ['OK']
      });
      alert.present();
    }

  }

  /* ====end==== */

  /*==== home button ==== */
  gotohomepage() {
    this.navCtrl.setRoot(HomePage);
  }


}
