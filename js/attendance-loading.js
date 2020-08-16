class arcc {
    constructor(end) {
      this.start = 0;
      this.current = this.start;
      this.end = end / 100 * 2 * PI;
    }
  
    inc() {
      if (this.current < this.end) {
        this.current = this.current + 0.08;
      } else {
        this.current = this.end;
      }
    }
  }
  
  var a;
  var start = false;
  
  function animate(per) {
    a = new arcc(per);
    start = true;
  }
  
  function setup() {
    var canvas = createCanvas(220, 220);
    canvas.parent('attendance')
    console.log(PI);
    animate(55);
  }
  
  function draw() {
    background('#fff');
    if(!start) {
      return;
    }
    strokeWeight(3);
    stroke("#3f51b5ff");
    fill('#fff');
    arc(height / 2, width / 2, 180, 180, a.start, a.current);
    
    fill("#3f51b5ff");
    arc(height / 2 + 180 / 2 * Math.cos(a.current), height/ 2 + 180 / 2 * Math.sin(a.current), 10, 10, 0, 2 * PI);
    
    fill("#000");
    noStroke();
    textSize(30);
    textAlign(CENTER, CENTER);
    text(Math.round(a.current * 100 / 2 / PI) + "%", height / 2, width / 2);
    a.inc();
  }