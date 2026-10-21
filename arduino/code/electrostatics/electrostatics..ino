const int sensePin = A0;  

void setup() {
  Serial.begin(9600);
  pinMode(chargePin, OUTPUT);
  
  
  Serial.println("DEBUG: Reading...");
}

void loop() {
  int raw = analogRead(sensePin);
  float voltage = (raw * 5.0) / 1024.0;

  // Send to Plotly
  Serial.println(voltage);

  // 2-second interval is perfect for a 100s Time Constant
  delay(2000); 
}
