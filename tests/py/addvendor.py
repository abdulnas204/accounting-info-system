from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities

class RedditNuker:
    def __init__(self):
        # self.driver = webdriver.Remote(
        #     command_executor='http://10.0.0.184:4444/wd/hub',
        #     desired_capabilities=DesiredCapabilities.CHROME)
        self.driver = webdriver.Chrome()


        self.driver.get('http://127.0.0.1:3000/vendor')

        self.results = []

    def get_results(self):
        return self.results

    def seedVendor(self, identifier):
        

nuke = RedditNuker()
nuke.login(1)
# nuke.start_loop()

print(nuke.get_results())
