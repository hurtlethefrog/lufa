// let order = {
//   ids: [40, 33, 35, 41, 34, 45],
//   quantity: [1, 4, 3, 1, 3, 1],
//   volume: [12000, 2500, 1500, 1500, 500, 500]
// };


// it's worth noting that I would expect an index of volume per product id's to be stored seperately and the input "array" would hold only id=>quantity

const Box = class {
  constructor(contents, id) {
    this.id = id;
    this.contents = contents;
  }
};

const boxFiller = (o, b) => {
  let volRemaining = 15000;
  let contents = {
    ids: [],
    quantity: []
  };
  let boxes = []
  let boxNum = 1

  while (o.quantity.every(ele => ele > 0) && volRemaining > Math.min(...o.volume)) {
    for (let index in o.ids) {
      if (o.quantity[index] > 0) {
        if (volRemaining - o.volume[index] >= 0) {
          contents.ids.push(o.ids[index]);
          volRemaining -= o.volume[index];
          o.quantity[index] -= 1;
          contents.quantity[index] += 1
        }
      }
    }
  }
  let box = new b(contents, boxNum)
  boxes.push(box)
  boxNum += 1
  volRemaining = 15000
  contents = {
    ids: [],
    quantity: []
  };

  return boxes
};

console.log(boxFiller(order, Box))
console.log(boxFiller())