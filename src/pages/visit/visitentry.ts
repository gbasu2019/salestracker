import { Component, OnInit } from '@angular/core';
import { CameraOptions, Camera } from '@ionic-native/camera';
import { Transfer, FileUploadOptions, TransferObject } from '@ionic-native/transfer';
import { Http, Headers } from '@angular/http';
import { HomePage } from '../home/home';
import { Geolocation } from '@ionic-native/geolocation';
import { NativeGeocoder, NativeGeocoderReverseResult, NativeGeocoderForwardResult } from '@ionic-native/native-geocoder';
import { NavController, AlertController, ViewController } from 'ionic-angular';
import { environment } from '../../app/environments/environments';

@Component({

  templateUrl: 'visitentry.html'
})

export class VisitEntryPage {
  pkuserid: any;
  dealerid: any;
  result: any;
  status: any;
  longitude: any;
  latitude: any;
  dealername: any;
  brandname: any;
  myimage: any;
  userData = { filename_base64: "" };
  locID: any;
  compID: any;
  flag: boolean = false;
  imageValue: any;
  public base64Image: any;
  public CompleteImage: Array<{ image: string }>;

  constructor(private camera: Camera, public viewCtrl: ViewController, private geolocation: Geolocation, private nativeGeocoder: NativeGeocoder, public http: Http, public navCtrl: NavController, public alertCtrl: AlertController) {


  }

  ngOnInit() {

    this.dealername = localStorage.getItem('dealername');
    this.brandname = localStorage.getItem('brandname');
    //console.log(this.dealername, this.brandname);
  }



  gotohomepage() {
    this.navCtrl.setRoot(HomePage);
  }

  public OpenCamera() {

    this.camera.getPicture({
      quality: 100,
      destinationType: this.camera.DestinationType.DATA_URL,
      sourceType: this.camera.PictureSourceType.CAMERA,
      allowEdit: false,
      encodingType: this.camera.EncodingType.JPEG,
      targetWidth: 500,
      targetHeight: 700,
      saveToPhotoAlbum: false
    }).then(imageData => {

      this.base64Image = "data:image/jpeg;base64," + imageData;

      this.CompleteImage.push(this.base64Image);


    }, error => {
      console.log("ERROR -> " + JSON.stringify(error));
    });
  }

  getGeo() {

    this.pkuserid = localStorage.getItem('pkuserid');
    this.dealerid = localStorage.getItem('dealerID');
    this.locID = localStorage.getItem('locationid');
    this.compID = localStorage.getItem('companyid');
    this.geolocation.getCurrentPosition().then((resp) => {

      this.longitude = resp.coords.longitude;
      this.latitude = resp.coords.latitude;

      var link = environment.apiHost + '/saveVisitEntry';
      var myData = JSON.stringify({ latitude: this.latitude, longitude: this.longitude, userid: this.pkuserid, dealerid: this.dealerid, locID: this.locID, compid: this.compID, filename_base64: this.base64Image });

      this.http.post(link, myData)
        .subscribe(data => {
          console.log(data);
          let alert = this.alertCtrl.create({
            title: 'Confirm',
            subTitle: 'Thank you for Visit',
            buttons: ['OK']
          });
          alert.present();

          this.viewCtrl.dismiss();



        }, error => {
          console.log(error);

        });

    }).catch((error) => {
      alert('Error getting location' + JSON.stringify(error));
    });

  }



}