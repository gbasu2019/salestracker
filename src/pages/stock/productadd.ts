import { Component, NgModule } from '@angular/core';
import { NavController, NavParams, AlertController } from 'ionic-angular';
import { OrderEntryPage } from '../order/orderentry';
import { Http } from '@angular/http';
import { HomePage } from '../home/home';
import { environment } from '../../app/environments/environments';
@Component({

  templateUrl: 'productadd.html'
})

export class ProductAddPage {

  /** variable declaration */

  productdata = [];
  productlists: any;
  brandlists: any[];
  categorylists: any[];
  subcategorylists: any;
  subsubcategorylists: any;
  selectedsubcategories: any;
  data: any = {};
  assignedBrandID: any;
  result: any = {};
  itemlist: any;
  status: any;
  itemliststatus: any;
  subcategorystatus: any;
  nextsubcategorylists: any;
  categoryID: any;

  /**end of variable declaration */

  constructor(public navctrl: NavController, public navParams: NavParams, public http: Http, public alertCtrl: AlertController) {

    this.assignedBrandID = localStorage.getItem('assignedBrandID');
    /** 1st category dropdown */
    var link = environment.apiHost + '/getOrderCategoryDropdownListNew';
    console.log(localStorage.getItem('dealerID'));
    var datalist = JSON.stringify({ assignedBrandID: this.assignedBrandID, DealerID: localStorage.getItem('dealerID') });
    this.http.post(link, datalist)
      .subscribe(data => {
        this.categorylists = JSON.parse(data['_body']);
        this.data.subcategoryid = 0;
        this.data.subsubcategoryid = 0;
        this.data.categoryid = 0;
      }, error => {
        console.log(error);
      });
    /**end -- 1st category dropdown*/

  }
  /** 2nd category dropdown */
  setSubcategoryValues(scategoryid) {

    this.subcategorylists = 0;
    var link = environment.apiHost + '/getOrderSubCategoryDropdownList';
    var mydata = JSON.stringify({ parentcategoryid: scategoryid });

    this.http.post(link, mydata)
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
  /** 3rd category dropdown */
  setSubsubcategoryValues(sscategoryid) {
    this.subsubcategorylists = 0;
    var link = environment.apiHost + '/getOrderSubCategoryDropdownList';
    var mydata = JSON.stringify({ parentcategoryid: sscategoryid });
    this.http.post(link, mydata)
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

  /** itemlist */

  setitemcategoryValues(categoryid) {

    var link = environment.apiHost + '/getOrderSubCategoryDropdownList';
    var mydata = JSON.stringify({ parentcategoryid: categoryid });

    this.http.post(link, mydata)
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

  /** incremental and decremental function*/
  private increment(product, index) {
    var inputValue = (<HTMLInputElement>document.getElementById("quantity-" + index));
    var ele = inputValue.getElementsByTagName("input");

    if (product.availablequantity == 0) {

      if (parseInt(product.quantity) < 5) {

        product.quantity++;
      }
    }
    else {

      for (var i = 0; i < ele.length; i++) {
        var elementvalue = ele[i].value;
        if (product.quantity < 999) {

          if (elementvalue.length == 4) {
            ele[i].value = elementvalue.substring(0, elementvalue.length - 1);
            ele[i].innerHTML = elementvalue.substring(0, elementvalue.length - 1);
            product.quantity = ele[i].value;

          }


        }
        else {


          if (elementvalue.length == 4 || elementvalue.length > 4) {

            ele[i].value = elementvalue.substring(0, elementvalue.length - 1);
            ele[i].innerHTML = elementvalue.substring(0, elementvalue.length - 1);
            product.quantity = ele[i].value;

          }
        }

      }

      product.quantity++;

    }




  }

  private decrement(product, index) {


    var inputValue = (<HTMLInputElement>document.getElementById("quantity-" + index));
    var ele = inputValue.getElementsByTagName("input");

    for (var i = 0; i < ele.length; i++) {
      var elementvalue = ele[i].value;
      if (product.quantity > 0 || product.quantity < 999) {
        if (elementvalue.length == 4) {
          ele[i].value = elementvalue.substring(0, elementvalue.length - 1);
          ele[i].innerHTML = elementvalue.substring(0, elementvalue.length - 1);
          product.quantity = ele[i].value;
        }
        ele[i].disabled = false;
        product.quantity--;
      }
    }













    //var elementvalue = ele[index].value;

  }
  /**end --incremental and decremental function*/
  setquatityLimit(product, index) {

    var inputValue = (<HTMLInputElement>document.getElementById("quantity-" + index));
    var ele = inputValue.getElementsByTagName("input");
    for (var i = 0; i < ele.length; i++) {
      var eleval = ele[i].value;
      if (product.availablequantity == 0) {
        if (parseInt(eleval) > 5) {
          ele[i].value = '5';
          ele[i].innerHTML = '5';
          product.quantity = ele[i].value;
        }
      }

      if (ele[i].value.length == 3) {


        if (product.quantity > 998) {
          ele[i].disabled = true;
        }
      }
      if ((ele[i].value.length == 4) || (ele[i].value.length > 4)) {
        //alert(ele[i].value.substring(0, ele[i].value.length - 1));
        // ele[i].value.slice(0, -1);
        ele[i].value = ele[i].value.substring(0, ele[i].value.length - 1);
        ele[i].innerHTML = ele[i].value.substring(0, ele[i].value.length - 1);
        // alert("value of textbox" + ele[i].value);


      }


    }

  }
  /** add product to orderlist */
  formSubmit(val) {
    var flag = 0;
    var obj1 = { orderitem: val };
    var obj2 = { categoryid: this.categoryID };
    for (var j = 0; j < val.length; j++) {
      if (val[j].quantity != 0) {
        flag = 1;
      }

    }

    var mergedData = Object.assign(obj1, obj2);
    if (flag == 1) {
      this.navctrl.push(OrderEntryPage, {
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
  /**end --- add product to orderlist*/
  /** home button */
  gotohomepage() {
    this.navctrl.setRoot(HomePage);
  }
  /**end */

}
