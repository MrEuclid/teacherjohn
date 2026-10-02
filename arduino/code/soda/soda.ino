void setup() {
  Serial.begin(9600);
  
  // REMOVED: analogReference(INTERNAL); 
  // By removing this, the Arduino automatically goes back to using 
  // the standard 5V system, allowing you to read up to 5.0 volts.

  delay(2000); 
}

void loop() {
  float voltageSum = 0;
  int samples = 200; 

  for(int i = 0; i < samples; i++) {
    int raw = analogRead(A3);
  //  Serial.println(raw);
    // CHANGED MATH: Multiply by 5.0 instead of 1.1
    voltageSum += (raw * 5.0) / 1024.0;
    delay(5);
  }

  float avgVoltage = voltageSum / (float)samples;

  Serial.println(avgVoltage);
  delay(15000); 
}
