#include <SoftwareSerial.h>

#define TXPin 1
#define RXPin 0
char c;
   
#include "String.h"


SoftwareSerial mySerial(RXPin, TXPin); // RX, TX // RX, TX


void setup() {
  // put your setup code here, to run once:
   Serial.begin(9600) ;
     mySerial.begin(9600) ;
    Serial.println("Read Bar Code Program Start  ") ;
   
}

void loop() {


      if (mySerial.available() > 0)
          {
            // Serial.println("Some Incoming") ;
              c= mySerial.read() ;
              Serial.write(c) ;       
          }
      if (Serial.available() > 0)
          {
           // Serial.println("Some Incoming") ;
              c= Serial.read() ;
              mySerial.print(c) ;       
          }

}
