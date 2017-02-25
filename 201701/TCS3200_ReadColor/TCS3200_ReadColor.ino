#include <Wire.h>
#include <LiquidCrystal_I2C.h>




#include <TimerOne.h>
//#include <EEPROM.h>
#include <EEPROMex.h>
#define S0     3
#define S1     4
#define S2     5
#define S3     6
#define OUT    2

#define mem0    1
#define mem1    11
#define mem2    21
#define mem3    31

int   g_count = 0;    // 頻率計算
int   g_array[3];     // 儲存 RGB 值
int   g_flag = 0;     // RGB 過濾順序
float g_SF[3];        // 儲存白平衡計算後之 RGB 補償係數

//eeprom_anything memory ;

EEPROMClassEx memory ;

// TCS3200 初始化與輸出頻率設定
LiquidCrystal_I2C lcd(0x27, 20, 4); // set the LCD address to 0x27 for a 16 chars and 2 line display


void TSC_Init()
{
  pinMode(S0, OUTPUT);
  pinMode(S1, OUTPUT);
  pinMode(S2, OUTPUT);
  pinMode(S3, OUTPUT);
  pinMode(OUT, INPUT);
 
  digitalWrite(S0, LOW);  // OUTPUT FREQUENCY SCALING 2%
  digitalWrite(S1, HIGH); 
}
 
// 選擇過濾顏色
void TSC_FilterColor(int Level01, int Level02)
{
  if(Level01 != 0)
    Level01 = HIGH;
 
  if(Level02 != 0)
    Level02 = HIGH;
 
  digitalWrite(S2, Level01); 
  digitalWrite(S3, Level02); 
}
 
void TSC_Count()
{
  g_count ++ ;
}
 
void TSC_Callback()
{
  switch(g_flag)
  {
    case 0: 
         Serial.println("->WB Start");
         TSC_WB(LOW, LOW);              // Red
         break;
    case 1:
         Serial.print("->Frequency R=");
         Serial.println(g_count);
         g_array[0] = g_count;
         TSC_WB(HIGH, HIGH);            // Green
         break;
    case 2:
         Serial.print("->Frequency G=");
         Serial.println(g_count);
         g_array[1] = g_count;
         TSC_WB(LOW, HIGH);             // Blue
         break;
 
    case 3:
         Serial.print("->Frequency B=");
         Serial.println(g_count);
         Serial.println("->WB End");
         g_array[2] = g_count;
         TSC_WB(HIGH, LOW);             //Clear(no filter)   
         break;
   default:
         g_count = 0;
         break;
  }
}
 
void TSC_WB(int Level0, int Level1)      //White Balance
{
  g_count = 0;
  g_flag ++;
  TSC_FilterColor(Level0, Level1);
   Timer1.setPeriod(1000000);             // us; 每秒觸發 
}
void ReadWhiteBalance()
{
     
     if (memory.readInt(mem0)  == 99)
        {
            g_SF[0] = memory.readFloat(mem1);
            g_SF[1] = memory.readFloat(mem2);
             g_SF[2] = memory.readFloat(mem3);
          LCDShowWhiteBalance(g_SF[0],g_SF[1],g_SF[2]) ;
        }
        else
        {
            Serial.println("Read White Balance Parameters Error") ;            
        }
        
  
}

 void LCDShowWhiteBalance(float a1, float a2,float a3)
 {
  lcd.setCursor(0, 1);     
  lcd.print("WB:") ;
  lcd.print(a1) ;
  lcd.print("/") ;
  lcd.print(a2) ;
  lcd.print("/") ;
  lcd.print(a3) ;
  
 }



 void LCDShowColor()
 {
  lcd.setCursor(0, 2);     
  lcd.print("Color:") ;
  lcd.print((int)(g_array[0] * g_SF[0])) ;
  lcd.print("/") ;
  lcd.print((int)(g_array[1] * g_SF[1])) ;
  lcd.print("/") ;
  lcd.print((int)(g_array[2] * g_SF[2])) ;
  
 }


void setup()
{
  Serial.begin(9600);
    lcd.init();                      // initialize the lcd

  // Print a message to the LCD.
  lcd.backlight();
  lcd.print("TCS 3200 Color");
  ReadWhiteBalance() ;
  
  TSC_Init();
  Timer1.initialize();             // defaulte is 1s
  Timer1.attachInterrupt(TSC_Callback);  
  attachInterrupt(0, TSC_Count, RISING);  
  
   delay(4000);
 // LCDShowColor();  //  show color on LCD2004
 //  delay(4000);
}
 
void loop()
{
   g_flag = 0;
 // ReadColor() ;
  Timer1.stop();
  Serial.print("R=");
  Serial.print((g_array[0] * g_SF[0]));
  Serial.print(",G=");
  Serial.print((g_array[1] * g_SF[1]));
  Serial.print(",B=");
  Serial.print((g_array[2] * g_SF[2]));
  Serial.print("\n");

  LCDShowColor();  //  show color on LCD2004
  Serial.println("Show Color on loop()");
   Timer1.resume();

    delay(4000);
}

