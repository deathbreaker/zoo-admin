import React from 'react';
import {render} from 'react-dom';
import Root from "./root/Root";
import './css/app.css';
import {BrowserRouter} from 'react-router-dom';
import registerServiceWorker from './registerServiceWorker';


const Application = () => (
    <div className="body">
        <BrowserRouter>
            <Root />
        </BrowserRouter>
    </div>
);

render(
    <Application/>,
    document.getElementById('root')
);
registerServiceWorker();

