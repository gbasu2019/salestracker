import { AutoCompleteService } from 'ionic2-auto-complete';
import { Http } from '@angular/http';
import { Injectable } from "@angular/core";
import 'rxjs/add/operator/map'
import { environment } from '../app/environments/environments';
@Injectable()
export class CompleteTestService implements AutoCompleteService {
  labelAttribute = "name";
  formValueAttribute = "id"

  constructor(private http: Http) {

  }

  getResults(keyword: string) {
    // var username = localStorage.getItem('username');
    var usergroupid = localStorage.getItem('usergroupid');
    var locationid = localStorage.getItem('locationid');
    var companyid = localStorage.getItem('companyid');
    var result = document.getElementsByClassName("searchbar-input");
    //var getDealerListAPI = environment.apiHost + '/getDealerList';
    return this.http.get(environment.apiHost + "/getDealerListnew/" + usergroupid + "/" + locationid + "/" + companyid + "/" + keyword)
      // return this.http.get(environment.apiHost + "/getDealerListnew/" + keyword)
      .map(
        result => {
          console.log(result['_body']);
          return result.json()
            .filter(item => item.name.toLowerCase().startsWith(keyword.toLowerCase()),

          )
        });
  }

}