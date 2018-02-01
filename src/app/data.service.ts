import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs/BehaviorSubject';

@Injectable()
export class DataService {

  private goals = new BehaviorSubject<any>(['Dados estão chegando do service', 'Outra linha que estar vindo junto kkk']);
  goal = this.goals.asObservable();

  constructor() { }

  changerGoal(goal) {
    this.goals.next(goal);
  }
}
