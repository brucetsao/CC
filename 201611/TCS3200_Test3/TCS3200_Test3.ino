#include <TimerOne.h>
#include <Adafruit_NeoPixel.h>

struct CRGB {
  union {
    struct {
            union {
                uint8_t r;
                uint8_t red;
            };
            union {
                uint8_t g;
                uint8_t green;
            };
            union {
                uint8_t b;
                uint8_t blue;
            };
        };
    uint8_t raw[3];
  };
};

#define S0     3
#define S1     4
#define S2     5
#define S3     6
#define OUT    2

int   g_count = 0;    // 頻率計算
int   g_array[3];     // 儲存 RGB 值
int   g_flag = 0;     // RGB 過濾順序
float g_SF[3];        // 儲存白平衡計算後之 RGB 補償係數

// 使用多少顆 WS2812B
#define NUM_LEDS 11 

// WS2812B DIN 街角街道 UNO 的哪根接腳
#define DATA_PIN 13

// Parameter 1 = number of pixels in strip
// Parameter 2 = pin number (most are valid)
// Parameter 3 = pixel type flags, add together as needed:
//   NEO_KHZ800  800 KHz bitstream (most NeoPixel products w/WS2812 LEDs)
//   NEO_KHZ400  400 KHz (classic 'v1' (not v2) FLORA pixels, WS2811 drivers)
//   NEO_GRB     Pixels are wired for GRB bitstream (most NeoPixel products)
//   NEO_RGB     Pixels are wired for RGB bitstream (v1 FLORA pixels, not v2)
Adafruit_NeoPixel ws2812 = Adafruit_NeoPixel(NUM_LEDS, DATA_PIN, NEO_GRB + NEO_KHZ800);

CRGB leds[NUM_LEDS];
 
// TCS3200 初始化與輸出頻率設定
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
 
void setup()
{
  TSC_Init();
  Serial.begin(9600);

  ws2812.begin();
  ws2812.show();  // Initialize all pixels to 'off'  

  Timer1.initialize();             // defaulte is 1s
  Timer1.attachInterrupt(TSC_Callback);  
  attachInterrupt(0, TSC_Count, RISING);  
 
  delay(4000);
 
  for(int i=0; i<3; i++)
    Serial.println(g_array[i]);
 
  g_SF[0] = 255.0/ g_array[0];     // R 補償係數
  g_SF[1] = 255.0/ g_array[1] ;    // G 補償係數
  g_SF[2] = 255.0/ g_array[2] ;    // B 補償係數
 
  Serial.println(g_SF[0]);
  Serial.println(g_SF[1]);
  Serial.println(g_SF[2]);

  for(int i=0; i<3; i++)
    Serial.println(int(g_array[i] * g_SF[i]));
  Serial.println("Finish Calibration.");
  delay(4000);
 
}
 
void loop()
{
  g_flag = 0;
  // R
  for( int i = 0; i < NUM_LEDS; i++ )
  {
    leds[i].r = int(g_array[0] * g_SF[0]);
    leds[i].g = int(g_array[1] * g_SF[1]);
    leds[i].b = int(g_array[2] * g_SF[2]);
    ws2812.setPixelColor( i, leds[i].r, leds[i].g, leds[i].b );
  }
  Timer1.stop();

  Serial.println(leds[0].r);
  Serial.println(leds[0].g);
  Serial.println(leds[0].b);

  ws2812.show();  // Sends the value to the LED

  Timer1.resume();

  delay(4000);
}
