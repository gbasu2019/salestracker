import { BrowserModule } from '@angular/platform-browser';
import { ErrorHandler, NgModule } from '@angular/core';
import { IonicApp, IonicErrorHandler, IonicModule } from 'ionic-angular';
import { MyApp } from './app.component';
import { HomePage } from '../pages/home/home';
import { ListPage } from '../pages/list/list';
import { LoginPage } from '../pages/login/login';
import { AccountledgerPage } from '../pages/accountledger/accountledger';
import { StockdetailsPage } from '../pages/stock/stockdetails';
import { StatusBar } from '@ionic-native/status-bar';
import { OrderListPage } from '../pages/order/orderlist';
import { ProductListPage } from '../pages/stock/productlist';
import { ProductAddPage } from '../pages/stock/productadd';
import { Geolocation } from '@ionic-native/geolocation';
import { NativeGeocoder } from '@ionic-native/native-geocoder';
import { GrnPage } from '../pages/grn/grn';
import { CollectionPage } from '../pages/collection/collection';
import { RejectlistPage } from '../pages/grn/rejectlist';
import { VisitEntryPage } from '../pages/visit/visitentry';
import { VisitListPage } from '../pages/visit/visitlist';
import { ReportPage } from '../pages/report/reportpage';
import { ChartsModule } from 'ng2-charts';
import { Transfer, FileUploadOptions, TransferObject } from '@ionic-native/transfer';
import { DatePickerModule } from 'ionic2-date-picker';
import { OrderEntryPage } from '../pages/order/orderentry';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { Device } from '@ionic-native/device';
import { Camera } from '@ionic-native/camera';
import { GrnviewPage } from '../pages/grn/grnview';
import { CollectionlistPage } from '../pages/collection/collectionlist';
import { DatePipe } from '@angular/common';
import { PopoverPage } from '../pages/visit/popover';
import { IonicImageViewerModule } from 'ionic-img-viewer';
import { AppVersion } from '@ionic-native/app-version';
import { CompleteTestService } from '../providers/CompleteTestService';
import { AutoCompleteModule } from 'ionic2-auto-complete';
import { ForgotpasswordPage } from '../pages/login/forgotpassword';
import { ResetpasswordPage } from '../pages/login/resetpassword';

@NgModule({
  declarations: [
    MyApp,
    HomePage,
    ListPage,
    LoginPage,
    OrderListPage,
    ProductListPage,
    ProductAddPage,
    ReportPage,
    OrderEntryPage,
    GrnPage,
    CollectionPage,
    RejectlistPage,
    AccountledgerPage,
    StockdetailsPage,
    VisitEntryPage,
    VisitListPage,
    GrnviewPage,
    CollectionlistPage,
    PopoverPage,
    ForgotpasswordPage,
    ResetpasswordPage,


  ],
  imports: [
    BrowserModule,
    AutoCompleteModule,
    HttpModule,
    IonicModule.forRoot(MyApp),
    ChartsModule,
    DatePickerModule, FormsModule, IonicImageViewerModule

  ],
  bootstrap: [IonicApp],
  entryComponents: [
    MyApp,
    HomePage,
    ListPage,
    LoginPage,
    OrderListPage,
    ProductListPage,
    ProductAddPage,
    ReportPage,
    OrderEntryPage,
    GrnPage,
    CollectionPage,
    RejectlistPage,
    AccountledgerPage,
    StockdetailsPage,
    VisitEntryPage,
    VisitListPage,
    GrnviewPage,
    CollectionlistPage,
    PopoverPage,
    ForgotpasswordPage,
    ResetpasswordPage,
  ],
  providers: [
    StatusBar,
    Device,
    Camera,
    DatePipe,
    Transfer,
    AppVersion,
    Geolocation,
    NativeGeocoder,
    CompleteTestService,
    { provide: ErrorHandler, useClass: IonicErrorHandler },


  ]
})
export class AppModule { }
