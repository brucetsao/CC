#include <Wire.h>


#define TXPin 3
#define RXPin 2
#define turnon HIGH
#define turnoff LOW

#include "String.h"


//NewSoftSerial mySerial(RXPin , TXPin ); // RX, TX
//HardwareSerial mySerial =  HardwareSerial(3, 2);

void setup() {
  // put your setup code here, to run once:
    Serial.begin(9600) ;
  //  Serial1.begin(9600,SERIAL_8N1) ;
    Wire.begin(4) ;
    Wire.onReceive(receiveEvent) ;
    Serial.println("My Program Start") ;
   // Serial1.println("My Program Start") ;
}

void loop() {
    delay(100) ;

}

void receiveEvent(int howMany)
{
    unsigned char x = Wire.read() ;
    Serial.print("Data is :(") ;
    Serial.print(x) ;
    Serial.print(")\n") ;
}

