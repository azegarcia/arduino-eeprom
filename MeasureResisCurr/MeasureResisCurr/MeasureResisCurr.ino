/*
Author: Rhodger Dominique Soriano
Program: Measuring the current of a resistor
Date: 2021
*/

// Variables for Measured Voltage and Calculated Current
double Vout = 0;
double Current = 0;
 
// Constants for Scale Factor
// Use one that matches your version of ACS712
// Comment out the unused scale factor to avoid confusion
 
//const double scale_factor = 0.185; // 5A
const double scale_factor = 0.1; // 20A
//const double scale_factor = 0.066; // 30A
 
// Constants for A/D converter resolution
// Arduino has 10-bit ADC, so 1024 possible values
// Reference voltage is 5V if not using AREF external reference
// Zero point is half of Reference Voltage
 
const double vRef = 5.00;
const double resConvert = 1024;
double resADC = vRef/resConvert;
double zeroPoint = vRef/2;
 
void setup(void){ 
  Serial.begin(9600);
  for(int i = 0; i < 2; i++) {
    Vout = (Vout + (resADC * analogRead(A0)));   
    delay(1000);
  }
  // This is to get Vout in mv
  Vout = Vout /1000;
  // Convert Vout into Current using Scale Factor
  Current = (Vout - zeroPoint)/ scale_factor;                   
  // Print Vout and Current to two Current = ");                  

  Serial.print("Resistor's Current = ");                  
  Serial.print(Current,2);
  Serial.println(" A");                             
 
  delay(1000);   
}
 
void loop(void){
}
