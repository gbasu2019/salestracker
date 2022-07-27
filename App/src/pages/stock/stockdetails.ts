import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';
import { ProductListPage } from './productlist';
import { Http } from '@angular/http';
import { HomePage } from '../home/home';
import { environment } from '../../app/environments/environments';
@Component({

  templateUrl: 'stockdetails.html'
})

export class StockdetailsPage {

  productdata = [];
  productlists: any;
  brandlists: any[];
  categorylists: any[];
  subcategorylists: any;
  subsubcategorylists: any;
  selectedsubcategories: any;
  data: any = {};
  brandname: string;
  result: any = {};
  itemlist: any;
  status: any;
  itemliststatus: any;
  subcategorystatus: any;
  nextsubcategorylists: any;
  categoryID: any;
  assignedBrandID: any;
  constructor(public navctl: NavController, public http: Http) {

    /*===== get category dropdown ===== */
    this.assignedBrandID = localStorage.getItem('assignedBrandID');
    var getOrderCategoryDropdownListAPI = environment.apiHost + '/getOrderCategoryDropdownListNew';
    var getOrderCategoryDropdownListData = JSON.stringify({ assignedBrandID: this.assignedBrandID, DealerID: localStorage.getItem('dealerID') });
    this.http.post(getOrderCategoryDropdownListAPI, getOrderCategoryDropdownListData)
      .subscribe(data => {
        this.categorylists = JSON.parse(data['_body']);
        this.data.subcategoryid = 0;
        this.data.subsubcategoryid = 0;
        this.data.categoryid = 0;

      }, error => {
        console.log(error);
      });

    /*=== end === */

  }

  /*===== get 1st sub category dropdown or itemlist ===== */
  setSubcategoryValues(scategoryid) {
    this.subcategorylists = 0;
    var getOrderSubCategoryDropdownListAPI = environment.apiHost + '/getOrderSubCategoryDropdownList';
    var getOrderSubCategoryDropdownListData = JSON.stringify({ parentcategoryid: scategoryid });

    this.http.post(getOrderSubCategoryDropdownListAPI, getOrderSubCategoryDropdownListData)
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



      }, error => {
        console.log(error);
      });

  }

  /*===== get 2nd  sub category dropdown or itemlist ===== */
  setSubsubcategoryValues(sscategoryid) {

    this.subsubcategorylists = 0;
    var getOrderSubSubCategoryDropdownListAPI = environment.apiHost + '/getOrderSubCategoryDropdownList';
    var getOrderSubSubCategoryDropdownListData = JSON.stringify({ parentcategoryid: sscategoryid });
    this.http.post(getOrderSubSubCategoryDropdownListAPI, getOrderSubSubCategoryDropdownListData)
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


      }, error => {
        console.log(error);
      });

  }
  /*===== get 3rd sub category dropdown or itemlist ===== */
  setitemcategoryValues(categoryid) {

    var getItemListAPI = environment.apiHost + '/getOrderSubCategoryDropdownList';
    var getItemListData = JSON.stringify({ parentcategoryid: categoryid });

    this.http.post(getItemListAPI, getItemListData)
      .subscribe(data => {

        this.result = JSON.parse(data['_body']);

        if (this.result.status == 1) {
          this.nextsubcategorylists = this.result.productarray;
          this.itemlist = 0;
          if (this.nextsubcategorylists.length == 1) {
            this.data.categoryid = 0
          }
        }

      }, error => {
        console.log(error);
      });

  }

  /**======= to see list of product in productlist page ========== */
  gotoproductlist(productdata) {

    productdata = productdata;
    this.navctl.push(ProductListPage, {
      data: productdata
    });
  }
  /*====end==== */

  gotohomepage() {
    this.navctl.setRoot(HomePage);
  }

}