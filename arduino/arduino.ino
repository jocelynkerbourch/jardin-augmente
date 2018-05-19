#include <Arduino.h>
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClientSecure.h>

ESP8266WiFiMulti WiFiMulti;

const char* ssid     = "";
const char* password = "";
const char* host     = "";
const int httpPort   = 80;
const int trigPin = 2;  //D4
const int echoPin = 0;  //D3

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
    Serial.printf("[LEVEL] %d \n", distance);
    String distanceString = String(distance);
    
    HTTPClient http;
    String uri = String("/jardin/api/waterlevel.php?level=" + distanceString);
    Serial.println(uri);
    http.begin(host, httpPort, uri);
    int httpCode = http.GET();
    if(httpCode > 0) {
      String json = http.getString();
      Serial.println(json);
    }
    http.end();
  }
  delay(3000);  
}
