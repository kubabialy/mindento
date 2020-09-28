# Zadanie rekrutacyjne
- pochwal się nam swoimi umiejętnościami
- użyj dowolnego frameworka PHP
- ważna jest dla nas architektura wybranego rozwiązania
- nie ma limitu czasowego na wykonanie zadania
- rozwiązanie zadanie służy jedynie do celów rekrutacji i nie zostanie wykorzystane w przyszłości

## Zadanie
Zaimplementować API dla prostego systemu do wyliczania kwoty diet należnej za delegację dla pracownika w firmie X.

## Założenia biznesowe
- delegacje mogą się odbywać tylko do poniższych krajów, gdzie obowiązują następujące stawki diet za dany dzień:
    - <b>PL: 10 PLN</b>
    - <b>DE: 50 PLN</b>
    - <b>GB: 75 PLN</b>

- data rozpoczęcia delegacji nie może być późniejsza niż data zakończenia delegacji
- jednocześnie pracownik może przebywać tylko na 1 delegacji
- dieta za dzień należy się tylko wtedy, gdy pracownik w danym dniu przebywa minimum 8 godzin w delegacji
- za sobotę i niedzielę nie należy się dieta
- jeśli delegacja trwa więcej niż 7 dni kalendarzowych to wtedy stawka diety za każdy dzień następujący po 7 dniu kalendarzowym jest podwójna


##Wymagane endpointy
- (POST) dodanie pracownika do systemu. Brak danych wejściowych, w odpowiedzi zwracany jest identyfikator pracownika
- (POST) dodanie delegacji dla użytkownika, z danymi wejściowymi:
data i godzina rozpoczęcia delegacji
data i godzina zakończenia delegacji
identyfikator pracownika
kod kraju do którego odbywa się delegacja w formacie ISO 3166-1 alpha-2
- (GET) lista delegacji dla użytkownika podanego na wejściu, wraz z sumaryczną kwotą diety przysługującą za każdą delegację w formacie:

```json
[
  {
    "start": "2020-04-20 08:00:00",
    "end": "2020-04-21 16:00:00",
    "country": "PL",
    "amount": 20,
    "currency": "PLN"
  },
  {
    "start": "2020-04-24 20:00:00",
    "end": "2020-04-28 16:00:00",
    "country": "DE",
    "amount": 150,
    "currency": "PLN"
  }
]
```
