from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities

import random
import time

class Seeder:
    def __init__(self):
        # self.driver = webdriver.Remote(
        #     command_executor='http://10.0.0.184:4444/wd/hub',
        #     desired_capabilities=DesiredCapabilities.CHROME)
        self.driver = webdriver.Chrome()

        self.base_url = 'http://127.0.0.1:8000'
        self.endpoints = ['/vendor', '/customer','/invoice','/sale']

        self.results = []

        self.loadNLTKResources()
        self.loadStreetNameResources()
        self.loadCityNameResources()

    def loadNLTKResources(self):
        import nltk
        male = nltk.corpus.names.words('male.txt')
        female = nltk.corpus.names.words('female.txt')
        names = male + female
        self.names = names

    def loadStreetNameResources(self):
        street_names = []
        with open("streets.txt", 'r', newline=None) as file:
            for line in file:
                street_names.append(line)
        self.streets = street_names

    def loadCityNameResources(self):
        cities = []
        with open('city.txt', 'r', newline=None) as file:
            for l in file:
                # print(l)
                cities.append(l)

        chars = [city.rstrip('\n') for city in cities]

        self.cities = cities

    def _randNameFactory(self):
        return self.names[random.randint(0, len(self.names))] + " " + self.names[random.randint(0, len(self.names))]

    def _randStreetFactory(self):
        return str(random.randint(10, 10000)) + " " + self.streets[random.randint(0, len(self.streets))].replace('\n', '')

    def _randCityAndStateFactory(self):
        return self.cities[random.randint(0, len(self.cities))].replace('\n', '')

    def _randPhoneNumberFactory(self):
        return str(random.randint(0, 9)) + str(random.randint(0, 9)) + str(random.randint(0, 9)) + '-' + str(random.randint(0, 9)) + str(random.randint(0, 9)) + str(random.randint(0, 9)) + '-' + str(random.randint(0, 9)) + str(random.randint(0, 9)) + str(random.randint(0, 9)) + str(random.randint(0, 9))
    def _randZipCodeFactory(self):
        return str(random.randint(0, 9)) + str(random.randint(0, 9)) + str(random.randint(0, 9)) + str(random.randint(0, 9)) + str(random.randint(0, 9))
    def seedVendor(self, number):
        url = self.base_url + self.endpoints[0]
        self.driver.get(url)
        i = 0
        while i < number:
            try:
                # time.sleep(0.05)
                container = self.driver.find_element_by_css_selector('#container')
        
                name_input = container.find_element_by_css_selector('#name')
                company_input = container.find_element_by_css_selector('#company')
                email_input = container.find_element_by_css_selector('#email')
                address_input = container.find_element_by_css_selector('#address')
                city_input = container.find_element_by_css_selector('#city')
                phone_number_input = container.find_element_by_css_selector('#phone_number')
                state_input = container.find_element_by_css_selector('#state')
                zip_input = container.find_element_by_css_selector('#zip')
                country_input = container.find_element_by_css_selector('#country')
                notes_input = container.find_element_by_css_selector('#notes')
        
        
                name_seed = self._randNameFactory()
                company_seed = name_seed.split(' ')[0] + " Co."
                email_seed = name_seed.split(' ')[0] + "@testdomain.com"
    
                address_seed = self._randStreetFactory()
                phone_seed = self._randPhoneNumberFactory()
                # print(phone_seed)
        
                city_and_state = self._randCityAndStateFactory()
        
                city_seed = city_and_state.split(', ')[0]
                state_seed = city_and_state.split(', ')[1]
                zip_seed = '11111'
                country_seed = 'USA'
        
                name_input.send_keys(name_seed)
                company_input.send_keys(company_seed)
                email_input.send_keys(email_seed)
                address_input.send_keys(address_seed)
                phone_number_input.send_keys(phone_seed)
                city_input.send_keys(city_seed)
        
                list_of_inputs = state_input.text.split('\n')
                selectors = state_input.find_elements_by_tag_name('option')
                # selector = list(filter(lambda option: option.get_attribute('value') == state_seed,    selectors))
                for s in selectors:
                    attrib = s.get_attribute('value')
                    if attrib == state_seed.replace('\n', ''):
                        # time.sleep(0.05)
                        s.click()
                        # time.sleep(0.05)
                # phone_number_input.send_keys(phone_seed)
                zip_input.send_keys(zip_seed)
                country_input.send_keys(country_seed)
            
                i += 1
                submit_input = container.find_element_by_css_selector('#submit-form-button')
                submit_input.click()
            except Exception as e:
                time.sleep(1)
                alert = self.driver.switch_to.alert
                alert.accept()
                self.driver.get(url)
                pass
                print(e)




nuke = Seeder()
# nuke.loadNLTKResources()
nuke.seedVendor(50)

# nuke.login(1)
# nuke.start_loop()

# print(nuke.get_results())
