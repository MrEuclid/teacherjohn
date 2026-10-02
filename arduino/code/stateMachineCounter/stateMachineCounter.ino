const int pinA = 2;
const int pinB = 3;

int count = 0;
int sequenceState = 0; // 0=Idle, 1=A broken, 2=B broken after A

void setup() {
  Serial.begin(9600);
  pinMode(pinA, INPUT); // Assuming module has built-in pull-up or you added one
  pinMode(pinB, INPUT);
  
  Serial.println("DEBUG: Dual-Beam Counter Ready");
  delay(2000);
}

void loop() {
  // Read Sensors (HIGH = Beam Broken, LOW = Beam Intact)
  // *Adjust this depending on your specific wiring/module logic*
  bool breakA = digitalRead(pinA); 
  bool breakB = digitalRead(pinB);

  // --- STATE MACHINE ---
  
  // STATE 0: IDLE (Waiting for A)
  if (sequenceState == 0 && breakA && !breakB) {
    sequenceState = 1; // Movement started
    Serial.println("DEBUG: Activity Detected...");
  }
  
  // STATE 1: TRANSITION (A -> B)
  // We wait until B breaks while A is still broken (or just after)
  else if (sequenceState == 1 && breakB) {
    sequenceState = 2; // Person is fully blocking path
  }
  
  // STATE 2: COMPLETION (Walking out of B)
  // If B is now clear (and A is clear), the person has passed.
  else if (sequenceState == 2 && !breakA && !breakB) {
    count++;
    sequenceState = 0; // Reset
    
    // Output for Dashboard
    Serial.println(count); 
    
    // Slight debounce to prevent double-counting the trailing foot
    delay(250); 
  }
}
