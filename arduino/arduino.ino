#include <Arduino.h>
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClientSecure.h>
#include <ArduinoJson.h>

ESP8266WiFiMulti WiFiMulti;

const char* ssid     = "MONAL2";
const char* password = "Les8TomatesFarcies";
const char* host     = "flute-a-bec.kwaoo.me";
const int httpPort   = 80;
const int trigPin = 2;  //D4
const int echoPin = 0;  //D3

bool isOpen = false;
int Relay = 8;
long duration;
int distance;

void setup() 
{ 
  pinMode(trigPin, OUTPUT);
  pinMode(echoPin, INPUT);
  Serial.begin(9600);
  Serial.println("Starting...");

  for(uint8_t t = 4; t > 0; t--) {
      Serial.printf("[SETUP] WAIT %d...\n", t);
      Serial.flush();
      delay(1000);
  }

  WiFiMulti.addAP(ssid, password);
} 
 
void loop() 
{
  if((WiFiMulti.run() == WL_CONNECTED)) {
    digitalWrite(trigPin, LOW);
    delayMicroseconds(2);

    digitalWrite(trigPin, HIGH);
    delayMicroseconds(10);
    digitalWrite(trigPin, LOW);
    
    duration = pulseIn(echoPin, HIGH);
    distance= duration*0.034/2;

    HTTPClient http;
    
    Serial.println("[HTTP] begin...");
    String uri = "/jardin/api/waterlevel.php?level="&distance;
    http.begin(host, httpPort, uri);

    Serial.println("[HTTP] GET..."); 
    http.addHeader("Content-type", "application/json");
    int httpCode = http.GET();
    if(httpCode > 0) {
      String json = http.getString();
      Serial.print("[HTTP] GET... json:");
      Serial.println(json);
      StaticJsonBuffer<200> jsonBuffer;      
      JsonObject& root = jsonBuffer.parseObject(json);
      delay(3000);
    }else{
      Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
    }
    
    http.end();
  }
  delay(3000);  
}
