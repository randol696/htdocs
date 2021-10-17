import { Project } from "https://unpkg.com/leopard@^1/dist/index.esm.js";

import Stage from "./Stage/Stage.js";
import Takeout from "./Takeout/Takeout.js";

const stage = new Stage({ costumeNumber: 1 });

const sprites = {
  Takeout: new Takeout({
    x: -32.099999999999994,
    y: -17.73,
    direction: 90,
    costumeNumber: 4,
    size: 100,
    visible: true,
    layerOrder: 1
  })
};

const project = new Project(stage, sprites, {
  frameRate: 30 // Set to 60 to make your project run faster
});
export default project;
