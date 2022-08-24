// 問1:isEven関数を実行して、以下の配列から偶数だけが出力されるように実装してください。

let numbers = [2, 5, 12, 13, 15, 18, 22];
//ここに答えを実装してください。↓↓↓
function isEven(data) {
    for (let i = 0; i < data.length; i++) {
      if (data[i]%2 == 0) {
        console.log(data[i] + 'は偶数です');
      }
    }
}

isEven(numbers);

// 問2:以下の要件を満たすように実装してください。

class Car {

  //コンストラクタ
  constructor(gas, num) {
      this.gas = gas;
      this.num = num;
  }

  //メソッド
  getNumGas() {
      console.log(`ガソリンは${this.gas}です。ナンバーは${this.num}です。`);
  }
}

let mycar = new Car(150, 123);
mycar.getNumGas();