//#include <NewSoftSerial.h>
#include <AFSoftSerial.h>


#define TXPin 3
#define RXPin 2
#define turnon HIGH
#define turnoff LOW

#include "String.h"


//NewSoftSerial mySerial(RXPin , TXPin ); // RX, TX
HardwareSerial mySerial =  HardwareSerial(3, 2);

void setup() {
  // put your setup code here, to run once:
    Serial.begin(9600) ;
//    mySerial.begin(9600,SERIAL_7N1) ;
   mySerial.begin(9600,SERIAL_7N1) ;
    Serial.println("My Program Start") ;
    mySerial.println("My Program Start") ;
}

void loop() {
   char c;
  // put your main code here, to run repeatedly:
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
