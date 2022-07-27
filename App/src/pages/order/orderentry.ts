import { Component } from '@angular/core';
import { Http, Headers } from '@angular/http';
import { NavController, AlertController, ViewController, NavParams } from 'ionic-angular';
import { HomePage } from '../home/home';
import { ProductAddPage } from '../stock/productadd';
import { environment } from '../../app/environments/environments';
import { DatePipe } from '@angular/common';
import { FormControl, FormGroup, Validators } from '@angular/forms';
@Component({

  templateUrl: 'orderentry.html'
})

export class OrderEntryPage {
  orderitems: any = [];
  previtems: any = [];
  ordeNumber: String;
  product: any = [];
  response: any;
  dealerID: any;
  dealername: any;
  pkuserid: any;
  categoryname: any;
  deviceid: any;
  brandname: any;
  myDate: Date = new Date();
  newDate: any;
  status: any;
  ordernumber: any;
  cart: any = [];
  item: any = [];
  deliveryDate: any;
  deliveryAddress: any;
  paymentTerms: any;
  deliveryBy: any;
  customerComments: any;
  data: any = [];
  setdeliveryDate: any;
  orderform: FormGroup;
  constructor(public http: Http, public datePipe: DatePipe, public viewCtrl: ViewController, public alertCtrl: AlertController, public navCtrl: NavController, public navParams: NavParams) {

    this.product = navParams.get('data'); //get data from last page

  }

  ngOnInit() {

    this.orderform = new FormGroup({
      deliveryDate: new FormControl('', [Validators.required]),
      deliveryAddress: new FormControl('', [Validators.required]),
      paymentTerms: new FormControl('', [Validators.required]),
      deliveryBy: new FormControl('', [Validators.required]),
      customerComments: new FormControl('', [Validators.required]),

    });

    this.dealerID = localStorage.getItem('dealerID');
    this.dealername = localStorage.getItem('dealername');
    this.brandname = localStorage.getItem('brandname');
    this.pkuserid = localStorage.getItem('pkuserid');
    this.deviceid = localStorage.getItem('DeviceId');

    /**====== store item from storage added in cart which have already added in storage ======*/
    this.item = JSON.parse(localStorage.getItem('cartitem'));

    if (localStorage.getItem('cartitem') != null) {
      for (let i = 0; i < this.item.length; i++) {


        this.cart.push({
          availablequantity: this.item[i].availablequantity,
          categoryId: this.item[i].categoryId,
          categoryname: this.item[i].categoryname,
          productid: this.item[i].productid,
          productname: this.item[i].productname,
          quantity: this.item[i].quantity,
        });

      }

    }


    /**====== new product added for multiple selection from add product page ====== */
    if (this.product) {
      this.orderitems = this.product.orderitem;
    }

    for (let i = 0; i < this.orderitems.length; i++) {
      if (this.orderitems[i].quantity != 0) {

        this.cart.push({
          availablequantity: this.orderitems[i].availablequantity,
          categoryId: this.orderitems[i].categoryId,
          categoryname: this.orderitems[i].categoryname,
          productid: this.orderitems[i].productid,
          productname: this.orderitems[i].productname,
          quantity: this.orderitems[i].quantity,
        });
      }
    }

    /**=== added product store in cart and update storage  === */
    localStorage.setItem('cartitem', JSON.stringify(this.cart));

  }

  gotoaddProduct(dataval) {

    if (dataval.length != 0) {
      localStorage.setItem('cartitem', JSON.stringify(this.cart));
    }
    this.navCtrl.push(ProductAddPage);
  }
  gotohomepage() {
    this.cart = 0;
    localStorage.removeItem("cartitem");
    this.navCtrl.setRoot(HomePage);
  }

  /**=== Submit order with confirm box === */
  dataSaved(orderitem, ordernumber) {
    this.setdeliveryDate = this.datePipe.transform(this.deliveryDate, 'yyyy-MM-dd');
    this.data.push({
      deliveryDate: this.setdeliveryDate,
      deliveryAddress: this.deliveryAddress,
      paymentTerms: this.paymentTerms,
      deliveryBy: this.deliveryBy,
      customerComments: this.customerComments,

    });
    console.log(JSON.stringify(this.data));

    var flag = false;
    for (let j = 0; j < orderitem.length; j++) {
      if (orderitem[j].quantity != 0) {
        var flag = true;
      }



    }

    if (flag == true) {
      let alert = this.alertCtrl.create({
        title: 'Message',
        message: 'Do you want to place the order',
        buttons: [{
          text: "OK",
          handler: () => {
            this.finaldatasaved(orderitem);
          }
        },
        { text: "Cancel", }
        ]
      })
      alert.present();

    } else {
      let alert = this.alertCtrl.create({
        title: 'Message',
        message: 'Please add quantity to continue',
        buttons: [{
          text: "OK"
        }
        ]
      })
      alert.present();
    }
  }


  /**===== Final submit into database===== */

  finaldatasaved(orderitem) {
    var saveOrderDetailsAPI = environment.apiHost + '/saveOrderDetails';
    var flag = 0;


    var obj1 = {
      createdby: this.pkuserid, ordernumber: "", dealerid: this.dealerID, DeviceID: this.deviceid, location: 'kolkata', locationid: localStorage.getItem('locationid'), companyid: localStorage.getItem('companyid'), deliveryDate: this.setdeliveryDate, deliveryAddress: this.deliveryAddress, deliveryBy: this.deliveryBy,
      customerComments: this.customerComments, paymentTerms: this.paymentTerms
    };

    var obj3 = { orderitem };
    var mergedData = Object.assign(obj1, obj3);
    // console.log(mergedData);

    var saveOrderDetailsData = JSON.stringify(mergedData);

    this.http.post(saveOrderDetailsAPI, saveOrderDetailsData)
      .subscribe(data => {

        this.response = JSON.parse(data['_body']);
        for (var i = 0; i < this.response.length; i++) {
          this.status = this.response[i].status;
          this.ordernumber = this.response[i].order_no;
        }

        if (this.status == 1) {
          let alert = this.alertCtrl.create({
            title: 'Confirm',
            subTitle: '<p>Order saved successfully.</p><p> Your Order No.' + this.ordernumber + '</p>',
            buttons: ['OK']
          });
          alert.present();
          this.cart = 0;
          localStorage.removeItem("cartitem");
          this.navCtrl.setRoot(OrderEntryPage);
        }
      }, error => {
        console.log(error);

      });


  }
  /**====end==== */
  dataDeleted() {
    let alert = this.alertCtrl.create({
      title: 'Message',
      subTitle: 'Data deleted successfully',
      buttons: ['Ok']
    });
    alert.present();

  }
  dataCancel() {
    this.viewCtrl.dismiss();
  }

  /**========adjust the quantity======== */
  private increment(orderitem) {
    if (orderitem.availablequantity == 0) {
      if (orderitem.quantity < 5) {
        orderitem.quantity++;
      }

    }
    else {
      orderitem.quantity++;
    }

  }

  private decrement(orderitem) {
    if (orderitem.quantity > 0) {
      orderitem.quantity--;
    }

  }
  /**=====end===== */
}