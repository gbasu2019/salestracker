import { Component, ViewChild } from '@angular/core';
import { Nav, Platform } from 'ionic-angular';
import { StatusBar } from '@ionic-native/status-bar';
import { HomePage } from '../pages/home/home';
import { ListPage } from '../pages/list/list';
import { LoginPage } from '../pages/login/login';
import { OrderListPage } from '../pages/order/orderlist';
import { ProductListPage } from '../pages/stock/productlist';
import { ProductAddPage } from '../pages/stock/productadd';
import { ReportPage } from '../pages/report/reportpage';
import { GrnPage } from '../pages/grn/grn';
import { CollectionPage } from '../pages/collection/collection';
import { RejectlistPage } from '../pages/grn/rejectlist';
import { AccountledgerPage } from '../pages/accountledger/accountledger';
import { StockdetailsPage } from '../pages/stock/stockdetails';
import { VisitEntryPage } from '../pages/visit/visitentry';
import { VisitListPage } from '../pages/visit/visitlist';
import { GrnviewPage } from '../pages/grn/grnview';
import { CollectionlistPage } from '../pages/collection/collectionlist';
import { PopoverPage } from '../pages/visit/popover';
import { CompleteTestService } from '../providers/CompleteTestService';
import { AutoCompleteModule } from 'ionic2-auto-complete';
import { OrderEntryPage } from '../pages/order/orderentry';
import { ForgotpasswordPage } from '../pages/login/forgotpassword';
import { ResetpasswordPage } from '../pages/login/resetpassword';
@Component({
  templateUrl: 'app.html'
})
export class MyApp {

  @ViewChild(Nav) nav: Nav;

  rootPage: any = LoginPage;

  pages: Array<{ title: string, component: any }>;

  constructor(public platform: Platform, public statusBar: StatusBar) {

    this.initializeApp();

    // used for an example of ngFor and navigation
    this.pages = [
      { title: 'Home', component: HomePage },
      { title: 'Create Order', component: OrderEntryPage },
      { title: 'Visit', component: VisitEntryPage },
      { title: 'GRN', component: GrnPage },
      { title: 'Collection', component: CollectionPage },
      // { title: 'Dealer Leadger', component: AccountledgerPage },
      { title: 'Stock Details', component: StockdetailsPage },
      { title: 'Order List', component: OrderListPage },
      { title: 'Report', component: ReportPage },

    ];

  }

  initializeApp() {

    this.platform.ready().then(() => {
      //localStorage.clear();
      // Okay, so the platform is ready and our plugins are available.
      // Here you can do any higher level native things you might need.
      this.statusBar.styleDefault();

    });

  }



  openPage(page) {
    // Reset the content nav to have just this page
    // we wouldn't want the back button to show in this scenario
    this.nav.setRoot(page.component);
  }
}
