//#include <NewSoftSerial.h>
//#include <AFSoftSerial.h>


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
   Serial1.begin(19200) ;
    Serial.println("My Program Start") ;
   // Serial1.println("My Program Start") ;
}

void loop() {
   char c;
  // put your main code here, to run repeatedly:
      if (Serial1.available() > 0)
          {
            // Serial.println("Some Incoming") ;
              c= Serial1.read() ;
              Serial.write(c) ;       
          }
      if (Serial.available() > 0)
          {
           // Serial.println("Some Incoming") ;
              c= Serial.read() ;
              Serial1.write(c) ;       
          }

}
