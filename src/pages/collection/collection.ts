import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ViewController, AlertController } from 'ionic-angular';
import { CameraOptions, Camera } from '@ionic-native/camera';
import { Transfer, FileUploadOptions, TransferObject } from '@ionic-native/transfer';
import { Http, Headers } from '@angular/http';
import { HomePage } from '../home/home';
import { environment } from '../../app/environments/environments';
import { FormControl, FormGroup, Validators } from '@angular/forms';
@IonicPage()
@Component({
  selector: 'page-collection',
  templateUrl: 'collection.html',
})
export class CollectionPage {
  data = { 'amount': '', 'collection_type': '', 'transactionID': '', 'cheque': '', 'bankid': '', 'chequeNo': '' };
  myimage: any;
  public photos: any;
  public base64Image: string;
  public fileImage: string;
  public responseData: any;
  imageValue: any;
  dealername: any;
  brandname: any
  userData = { filename_base64: "" };
  pkuserid: string;
  dealerid: string;
  banklists: any = [];
  item: any = [];
  signupform: FormGroup;

  constructor(public http: Http, private alertCtrl: AlertController, private transfer: Transfer, private camera: Camera, public viewCtrl: ViewController, public navCtrl: NavController, public navParams: NavParams) {
  }

  ngOnInit() {
    this.data.collection_type = "Cash";
    this.photos = [];
    this.dealername = localStorage.getItem('dealername');
    this.brandname = localStorage.getItem('brandname');
    this.pkuserid = localStorage.getItem('pkuserid');
    this.dealerid = localStorage.getItem('dealerID');
    var getBankListsAPI = environment.apiHost + '/getBankLists';
    this.http.get(getBankListsAPI)
      .subscribe(data => {
        this.item = JSON.parse(data['_body'])
        for (var k = 0; k < this.item.length; k++) {
          this.banklists = this.item[k].banklist;
        }

      }, error => {
        console.log(error);

      });
    this.signupform = new FormGroup({
      amount: new FormControl('', [Validators.required]),
      collection_type: new FormControl('', [Validators.required]),
      transactionID: new FormControl('', [Validators.required]),
      cheque: new FormControl('', [Validators.required]),
      bankid: new FormControl('', [Validators.required]),
      chequeNo: new FormControl('', [Validators.required]),
    });
    this.signupform.controls['collection_type'].valueChanges.subscribe(value => {
      if (value == 'Cash') {
        this.signupform.controls['transactionID'].enable();
        this.signupform.controls['cheque'].disable();
        this.signupform.controls['bankid'].disable();
        this.signupform.controls['chequeNo'].disable();
      } else {
        this.signupform.controls['transactionID'].disable();
        this.signupform.controls['cheque'].enable();
        this.signupform.controls['bankid'].enable();
        this.signupform.controls['chequeNo'].enable();
      }
    });
  }


  formControlValueChanged() {
    const transactionID = this.data.transactionID;

    if (this.data.collection_type === 'Bank') {
      this.signupform = new FormGroup({
        transactionID: new FormControl('', []),
      });
    }

    //transactionID.updateValueAndValidity();

  }
  deletePhoto(index) {
    let confirm = this.alertCtrl.create({
      title: "Sure you want to delete this photo? There is NO undo!",
      message: "",
      buttons: [
        {
          text: "No",
          handler: () => {
            console.log("Disagree clicked");
          }
        },
        {
          text: "Yes",
          handler: () => {
            console.log("Agree clicked");
            this.photos.splice(index, 1);
          }
        }
      ]
    });
    confirm.present();
  }

  takePhoto() {

    let confirm = this.alertCtrl.create({
      title: "Sure you want to take photo?",
      message: "",
      buttons: [
        {
          text: "No",
          handler: () => {
            //this.navCtrl.push(CollectionPage);
          }
        },
        {
          text: "Yes",
          handler: () => {
            const options: CameraOptions = {
              quality: 50,
              destinationType: this.camera.DestinationType.DATA_URL,
              encodingType: this.camera.EncodingType.JPEG,
              mediaType: this.camera.MediaType.PICTURE,
              targetWidth: 450,
              targetHeight: 450,
              saveToPhotoAlbum: false
            };
            this.camera.getPicture(options).then(
              imageData => {
                this.base64Image = "data:image/jpeg;base64," + imageData;
                this.photos.push(this.base64Image);
                this.photos.reverse();
                this.sendData(imageData);
              },
              err => {
                console.log(err);
              }
            );
          }
        }
      ]
    });
    confirm.present();

  }

  selectPhoto() {



    let confirm = this.alertCtrl.create({
      title: "Sure you want to take photo?",
      message: "",
      buttons: [
        {
          text: "No",
          handler: () => {
            console.log("Disagree clicked");
          }
        },
        {
          text: "Yes",
          handler: () => {
            const options: CameraOptions = {
              quality: 50,
              sourceType: this.camera.PictureSourceType.PHOTOLIBRARY,

              destinationType: this.camera.DestinationType.DATA_URL,
              encodingType: this.camera.EncodingType.JPEG,
              targetWidth: 450,
              targetHeight: 450
            };

            this.camera.getPicture(options).then(
              imageData => {
                this.base64Image = "data:image/jpeg;base64," + imageData;
                this.photos.push(this.base64Image);
                this.photos.reverse();
                this.sendData(imageData);
              }, err => {
                console.log(err);
              });
          }
        }
      ]
    });
    confirm.present();



  }

  sendData(imageData) {
    this.userData.filename_base64 = imageData;
    this.imageValue = imageData;
  }



  submitData() {
    var collectionEntryAPI = environment.apiHost + '/collectionEntry';
    var obj1 = { userid: this.pkuserid, dealerid: this.dealerid, filename_base64: this.imageValue, locationid: localStorage.getItem('locationid'), companyid: localStorage.getItem('companyid') };
    var obj2 = this.data;
    var mergedData = Object.assign(obj1, obj2);
    var collectionEntryData = JSON.stringify(Object.assign(obj1, obj2));
    console.log(collectionEntryData);
    this.http.post(collectionEntryAPI, collectionEntryData)
      .subscribe(data => {
        if (collectionEntryData.length != 0) {
          let alert = this.alertCtrl.create({
            title: 'Confirm',
            subTitle: 'Data saved successfully.Continue?',
            buttons: [
              {
                text: "Yes",

              },
              {
                text: "No",
                handler: () => {
                  this.navCtrl.setRoot(HomePage);

                }

              }]

          });
          alert.present();
          this.navCtrl.setRoot(CollectionPage);
        }

      }, error => {
        console.log(error);

      });
    // this.navCtrl.setRoot(HomePage);
  }
  gotohomepage() {
    this.navCtrl.setRoot(HomePage);
  }
}
