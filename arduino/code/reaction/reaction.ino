/* Arduino Reaction Timer for Statistics Class
   Connect Button to Pin 2 and GND.
*/

const int buttonPin = 2;
const int ledPin = 12; 
int clicks = 0; // use to count clicks per cycle
void setup() {
  Serial.begin(9600);
  pinMode(ledPin, OUTPUT);
  // Internal pullup means 1 = Not Pressed, 0 = Pressed
  pinMode(buttonPin, INPUT_PULLUP); 
  
  randomSeed(analogRead(0)); // Seed randomizer with noise
  Serial.println("--- System Ready. Watch the LED! ---");
}
void loop() {
  // 1. Wait Phase (Replaces delay with a monitor)
  digitalWrite(ledPin, LOW);
  
  // Pick a random wait time (e.g., 3000 to 7000 ms)
  long randomWait = random(3000, 7000); 
  long startWait = millis();
  
  bool falseStart = false;

  // LOOP: Keep checking time until the randomWait is over
  while(millis() - startWait < randomWait) {
    // If they press the button NOW, it's a cheat!
    if(digitalRead(buttonPin) == LOW) {
      falseStart = true;
      break; // Exit the wait loop early
    }
  }

  // 2. Handle False Start (The Punishment)
  if (falseStart) {
    Serial.println("Error: Too Early!"); 
    // Blink LED fast to shame them
    for(int i=0; i<5; i++) {
        digitalWrite(ledPin, HIGH); delay(100);
        digitalWrite(ledPin, LOW); delay(100);
    }
    delay(1000); // Penalty wait
    return; // RESTART the entire loop immediately
  }

  // 3. The Real Test (Only happens if no false start)
  digitalWrite(ledPin, HIGH);
  unsigned long startTime = millis();

  // Wait for press
  while (digitalRead(buttonPin) == HIGH) {
     // Waiting for reaction...
  }
  
  unsigned long reactionTime = millis() - startTime;
  digitalWrite(ledPin, LOW);

  // 4. Send Clean Data
  if (reactionTime > 100 && reactionTime < 1000) {
      Serial.println(reactionTime);
  } else {
      Serial.println("Error");
  }

  delay(2000); // Cooldown
}
