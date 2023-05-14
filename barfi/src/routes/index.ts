import express from "express";
import puppeteer from 'puppeteer';

const router = express.Router();

/* GET home page. */
router.get('/', async (req, res, next) => {
    const browser = await puppeteer.launch();
    const page = await browser.newPage();

    await page.goto('https://developer.chrome.com/');

    // Set screen size
    await page.setViewport({width: 1080, height: 1024});
    //
    // // Type into search box
    // await page.type('.search-box__input', 'automate beyond recorder');
    //
    // // Wait and click on first result
    // const searchResultSelector = '.search-box__link';
    // await page.waitForSelector(searchResultSelector);
    // await page.click(searchResultSelector);
    res.json({title: (await page.title())});
    await browser.close();
});
export default router