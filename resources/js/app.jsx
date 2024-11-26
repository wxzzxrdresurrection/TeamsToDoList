import './bootstrap';
import '../css/app.css';

import { createInertiaApp } from '@inertiajs/react'
import { createRoot } from 'react-dom/client'
import { StrictMode } from 'react';
import { BrowserRouter, Routes, Route } from 'react-router-dom';



createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.jsx', { eager: true })
    return pages[`./Pages/${name}.jsx`]
  },
  setup({ el, App, props }) {
    createRoot(el).render(
        <StrictMode>
            <BrowserRouter>
            <Routes>
                <Route path='*' element={<App {...props}/>}/>
            </Routes>
            </BrowserRouter>
        </StrictMode>
    )
  },
})
