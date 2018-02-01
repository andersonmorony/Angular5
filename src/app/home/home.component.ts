import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ActivatedRoute } from '@angular/router';
import { DataService } from '../data.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  listas: any;

  constructor(private route: ActivatedRoute, private router: Router, private _data: DataService) { }

  ngOnInit() {

    this._data.goal.subscribe(res => this.listas = res);

  }

  sendMeHome() {
    this.router.navigate(['About']);
  }

}
