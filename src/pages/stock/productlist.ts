import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { Http } from '@angular/http';
import { HomePage } from '../home/home';
import { environment } from '../../app/environments/environments';
@Component({

  templateUrl: 'productlist.html'
})

export class ProductListPage {
  product: any;
  brand: string;
  category: string;
  subcategory;
  products: any[]
  text: string;
  categoryName: string;
  categoryid: string;
  result: any = {};
  itemlist: any;
  constructor(public navParams: NavParams, public http: Http, public navctl: NavController) {

    /**====coming data from last page ==== */
    this.product = navParams.get('data');

    /**===== display category name ===== */
    if (this.product.categoryid != 0) {
      this.category = this.product.categoryid;
    }
    if (this.product.selectedcategory != 0) {
      this.category = this.product.selectedcategory;
    }
    if (this.product.subcategoryid != 0) {
      this.category = this.product.subcategoryid;
    }
    if (this.product.subsubcategoryid != 0) {
      this.category = this.product.subsubcategoryid;
    }
    /**===== calling function to display item =======*/
    var getOrderSubCategoryDropdownListAPI = environment.apiHost + '/getOrderSubCategoryDropdownList';
    var getOrderSubCategoryDropdownListData = JSON.stringify({ parentcategoryid: this.category });

    this.http.post(getOrderSubCategoryDropdownListAPI, getOrderSubCategoryDropdownListData)
      .subscribe(data => {

        this.result = JSON.parse(data['_body']);
        this.itemlist = this.result.productarray;

      }, error => {
        console.log(error);
      });

  }
  /**==== end ==== */
  gotohomepage() {
    this.navctl.setRoot(HomePage);
  }




}