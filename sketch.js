var streams = [];
var fadeInterval = 1;
var symbolSize = 18;
function preload(){
  loadImage("TechnopolyLogo.png");
}
function setup() {
  createCanvas(
    window.innerWidth,
    window.innerHeight
  );
  background(0);

  var x = 0;
  for (var i = 0; i <= width / symbolSize; i++) {
    var stream = new Stream();
    stream.generateSymbols(x, random(-2000, 0));
    streams.push(stream);
    x += symbolSize
  }

  textFont('Consolas');
  textSize(symbolSize);
  
}
function mousePressed(){
  if((mouseY>=height/2-50) && (mouseY<=height/2+50) && mouseX>=450 && mouseX<=900){
    open("login.html","_self");
    noLoop();

  }
}
function draw() {
  background(0, 150);
  technopoly();
  textFont('Consolas');
  streams.forEach(function(stream) {
    stream.render();
  });
}

function Symbol(x, y, speed, first, opacity) {
  this.x = x;
  this.y = y;
  this.value;

  this.speed = speed;
  this.first = first;
  this.opacity = opacity;

  this.switchInterval = round(random(2, 25));

  this.setToRandomSymbol = function() {
    var charType = round(random(0, 5));
    if (frameCount % this.switchInterval == 0) {
      if (charType = 1) {
        // set it to telugu
        this.value = String.fromCharCode(
          0x00C0 + round(random(0, 96))
        );
      } 
      else if(charType = 2){
        this.value = String.fromCharCode(
            0x0020 + round(random(0, 96))
          );
      }
      else if(charType = 3){
        this.value = String.fromCharCode(
            0x0920 + round(random(0, 96))
          );
      }
      else {
        // set it to numeric
        this.value = round(random(0,9));
      }
    }
  }

  this.rain = function() {
    this.y = (this.y >= height) ? 0 : this.y += this.speed;
  }

}

function Stream() {
  this.symbols = [];
  this.totalSymbols = round(random(5, 35));
  this.speed = random(5, 22);

  this.generateSymbols = function(x, y) {
    var opacity = 255;
    var first = round(random(0, 4)) == 1;
    for (var i =0; i <= this.totalSymbols; i++) {
      symbol = new Symbol(
        x,
        y,
        this.speed,
        first,
        opacity
      );
      symbol.setToRandomSymbol();
      this.symbols.push(symbol);
      opacity -= (255 / this.totalSymbols) / fadeInterval;
      y -= symbolSize;
      first = false;
    }
  }

  this.render = function() {
    this.symbols.forEach(function(symbol) {
      if (symbol.first) {
        fill(140, 255, 170, symbol.opacity);
      } else {
        fill(random(100,255), 0, 70, symbol.opacity);
      }
      text(symbol.value, symbol.x, symbol.y);
      symbol.rain();
      symbol.setToRandomSymbol();
    });
  }
}
var technopoly = function(){
    textSize(100);
   fill(random(200,255),20,10);
   textFont('broadway');
    text("Technopoly",width/3-80,height/2);
    
    textSize(symbolSize);
    textFont("consolas");
}
