import { Component, OnInit } from '@angular/core';
import { trigger,  state,  style,  animate,  transition, query, keyframes, stagger } from '@angular/animations';
import { DataService } from '../data.service';


@Component({
  selector: 'app-about',
  templateUrl: './about.component.html',
  styleUrls: ['./about.component.css'],
  animations: [

    trigger('goals', [
      transition('* => *', [
        query(':enter', style({ opacity: 0 }), {optional: true}),

        query(':enter', stagger('300ms', [
          animate('.6s ease-in', keyframes([
            style({opacity: 0, transform: 'translateY(-75%)', offset: 0}),
            style({opacity: .5, transform: 'translateY(25px)', offset: .6}),
            style({opacity: 1, transform: 'translateY(0)', offset: 1}),
          ]))]), {optional: true}),

        query(':leave', stagger('300ms', [
          animate('.6s ease-in', keyframes([
            style({opacity: 1, transform: 'translateY(0)', offset: 0}),
            style({opacity: .5, transform: 'translateY(25px)', offset: .6}),
            style({opacity: 0, transform: 'translateY(-75%)', offset: 1}),
          ]))]), {optional: true}),

      ])
    ])
  ]
})
export class AboutComponent implements OnInit {

  BemVIndo: string = 'BEM VINDO!';
  nome: string = 'Ex: Exterminar o comunismo';
  publicDeals: any[] = [];
  qtdList: int = 0;
  msgErro: string;
  classVazio: string;

  constructor(private _data: DataService) { }


  ngOnInit() {
    this._data.goal.subscribe(res => this.publicDeals = res);
    this._data.changerGoal(this.publicDeals);

    this.qtdList = this.publicDeals.length;
    this.msgErro = '';
  }

  nomeClear()
  {
    this.nome = '';
  }
  nomeVazio()
  {
    if(this.nome == '')
    {
      this.classVazio = 'vazio';
    }
  }
  Add()
  {
      if(this.nome != '')
      {
        this.publicDeals.push(this.nome);
        this.nome = '';
        this.qtdList = this.publicDeals.length;
        this.msgErro = '';
        this.classVazio = '';
        this._data.changerGoal(this.publicDeals);
      }
      else
      {
        this.msgErro = 'Preencha o input antes de enviar';
      }
  }
  removeItem(i)
  {

    this.publicDeals.splice(i, 1);
    this._data.changerGoal(this.publicDeals);

  }

}
