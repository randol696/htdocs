/* eslint-disable require-yield, eqeqeq */

import {
  Sprite,
  Trigger,
  Watcher,
  Costume,
  Color,
  Sound
} from "https://unpkg.com/leopard@^1/dist/index.esm.js";

export default class Takeout extends Sprite {
  constructor(...args) {
    super(...args);

    this.costumes = [
      new Costume("takeout-a", "./Takeout/costumes/takeout-a.svg", {
        x: 33,
        y: 41
      }),
      new Costume("takeout-b", "./Takeout/costumes/takeout-b.svg", {
        x: 33,
        y: 42
      }),
      new Costume("takeout-c", "./Takeout/costumes/takeout-c.svg", {
        x: 33,
        y: 53
      }),
      new Costume("takeout-d", "./Takeout/costumes/takeout-d.svg", {
        x: 40,
        y: 42
      }),
      new Costume("takeout-e", "./Takeout/costumes/takeout-e.svg", {
        x: 41,
        y: 35
      })
    ];

    this.sounds = [new Sound("pop", "./Takeout/sounds/pop.wav")];

    this.triggers = [
      new Trigger(Trigger.GREEN_FLAG, this.whenGreenFlagClicked)
    ];
  }

  *whenGreenFlagClicked() {
    while (true) {
      yield* this.glide(1, this.random(-240, 240), this.random(-180, 180));
      this.costumeNumber += 1;
      yield;
    }
  }
}
