const int chargePin = 12; 
const int sensePin = A0;  

void setup() {
  Serial.begin(9600);
  pinMode(chargePin, OUTPUT);
  
  // CHARGE PHASE (10 seconds to be sure with 100k influence)
  digitalWrite(chargePin, HIGH);
  delay(10000); 
  
  // DISCHARGE PHASE
  pinMode(chargePin, INPUT); 
  Serial.println("DEBUG: 100k RC Discharge Starting...");
}

void loop() {
  int raw = analogRead(sensePin);
  float voltage = (raw * 5.0) / 1024.0;

  // Send to Plotly
  Serial.println(voltage);

  // 2-second interval is perfect for a 100s Time Constant
  delay(2000); 
}
