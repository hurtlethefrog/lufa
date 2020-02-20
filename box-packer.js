// in PHP this will hand off the items in order, JS does it sequentially by integer value of keys

let order = {
  40: {
    quantity: 5,
    volume: 12000
  },
  33: {
    quantity: 6,
    volume: 2500
  },
  35: {
    quantity: 3,
    volume: 1500
  },
  41: {
    quantity: 1,
    volume: 1500
  },
  34: {
    quantity: 3,
    volume: 500
  },
  45: {
    quantity: 1,
    volume: 500
  }
};

const orderFilled = o => {
  let array = [];
  for (let ids in o) {
    array.push(o[ids].quantity);
  }
  if (array.every(ele => ele === 0)) {
    return true;
  } else {
    return false;
  }
};
const currentAvailableVolumes = o => {
  let output = [];
  for (let ids in o) {
    if (o[ids].quantity > 0) {
      output.push(o[ids].volume);
    }
  }
  return Math.min(...output);
};

const boxFull = (max, box, min) => {
  if (box.vol + min > max) {
    return true;
  } else return false;
};

const boxFiller = o => {
  let modOrder = o;
  let maxVol = 15000;
  let currentBox = {
    vol: 0,
    contents: {}
  };
  let boxes = [];
  while (orderFilled(modOrder) === false) {
    for (let ids in modOrder) {
      if (boxFull(maxVol, currentBox, currentAvailableVolumes(modOrder))) {
        boxes.push(currentBox.contents);
        currentBox.vol = 0;
        currentBox.contents = {};
      } else if (maxVol - currentBox.vol >= currentAvailableVolumes(modOrder)) {
        if (
          modOrder[ids].quantity > 0 &&
          currentBox.vol + modOrder[ids].volume <= maxVol
        ) {
          currentBox.vol += modOrder[ids].volume;
          modOrder[ids].quantity -= 1;
          console.log("the order is being modified\n", modOrder);
          if (!currentBox.contents[ids]) {
            currentBox.contents[ids] = 1;
          } else {
            currentBox.contents[ids] += 1;
          }
          console.log("the box is being modified", currentBox, "\n \n \n");
        }
      }
    }
  }
  return boxes;
};
let sorted = boxFiller(order)
let index = 1
console.log("The order will be placed into", sorted.length, "boxes");
for (let box of sorted) {
  console.log("in box", index, "we will place", box)
  index ++
}