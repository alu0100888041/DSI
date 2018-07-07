'use strict'

//Singleton
const ClassFlight = (()=> {   //CLase Global Nombre de Compañias y Numero de vuelos

function ClassFlight() {
  var name = [];
  var name_ = 0;
  var number = [];
  var number_ = 0;
  var move = 0;

  this.getName = function(i){
    return name[i];
  };

  this.getName_ = function(){
    return name_;
  };

  this.getFlight = function(i){
    return number[i];
  };

  this.getFlight_ = function(){
    return number_;
  };

  this.setName = function(name_){
    name[move] = name_;
    name_++;
  };

  this.setFlight = function(flight_){
    number[move] = flight_;
    number_ = number_ + parseInt(flight_);
    move = move + 1;
    name_++;
  };
}

var instance;

return{
getInstance:() => {
  if(!instance){
    instance = new ClassFlight();
  }
  return instance;
  }
}


})();

const instance1 = ClassFlight.getInstance();
const instance2 = ClassFlight.getInstance();
const instance3 = ClassFlight.getInstance();

function actualizar_info(name, number){

  instance1.setName(name);
  instance2.setFlight(number);


  var texto = "Actualmente hay " + instance2.getName_() + " compañías trabajando con TripFinder con un total de " + instance1.getFlight_() + " vuelos: ";

for (var i = 0; i < instance3.getName_(); i++){
  texto += "<p> " + instance3.getName(i) + " => " + instance3.getFlight(i) + " vuelos.";
}

  return texto;

}
