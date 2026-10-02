#include <DHT11.h>

DHT11 dht11(2);
const int ledPin = 13; // Onboard LED

// Accumulators
float tempSum = 0;
float humSum = 0;
int readCount = 0;

// Timing: 15 seconds
unsigned long sampleInterval = 15000; 

void setup() {
    Serial.begin(9600);
    pinMode(ledPin, OUTPUT);
    delay(2000); // Initial boot delay
}

void loop() {
    int temperature = 0;
    int humidity = 0;
    int result = dht11.readTemperatureHumidity(temperature, humidity);
 // Serial.println(temperature);
    // 1. Flash LED for feedback
    digitalWrite(ledPin, HIGH);
    delay(200);
    digitalWrite(ledPin, LOW);
  

    // 2. Process reading
    if (result == 0 && temperature < 100 && humidity <= 100) {
        tempSum += temperature;
        humSum += humidity;
        readCount++;
    //   Serial.print(readCount,temperature);
    }

    // 3. Check if we reached 60 readings (15 minutes) now 1.5 for testing
    if (readCount >= 60) {
        // Calculate the Means
        float avgTemp = tempSum / (float)readCount;
        float avgHum = humSum / (float)readCount;

        // Send to Plotly Dashboard
        Serial.print(avgTemp);
        Serial.print(",");
        Serial.println(avgHum);

        // Reset for next 15-minute block
        tempSum = 0;
        humSum = 0;
        readCount = 0;
    }

    // 4. Wait 15 seconds for next sample
    // Subtracting the 200ms LED delay for precision
    delay(sampleInterval - 200); 
}
