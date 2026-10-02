void setup() {
  Serial.begin(9600);
  
  // Change the "yardstick" to the internal 1.1V reference
  // This is much more stable than the 5V rail
  analogReference(INTERNAL); 

  delay(2000); // Give browser time to connect
}

void loop() {
  float voltageSum = 0;
  int samples = 20; // Increased samples for even better smoothing

  for(int i = 0; i < samples; i++) {
    int raw = analogRead(A0);
  //  Serial.print("raw");
  //  Serial.println(raw);
    // NEW MATH: (raw * 1.1) / 1024
    voltageSum += (raw * 1.1) / 1024.0;
    delay(5);
  }

  float avgVoltage = voltageSum / (float)samples;

  // Send to Plotly Dashboard
  // The dashboard will graph this as a single line
  Serial.println(avgVoltage);

  // Measure every 30 seconds
  delay(10000); 
}
