import { createBrowserRouter } from 'react-router';
import { Layout } from './components/Layout';
import { Home } from './pages/Home';
import { About } from './pages/About';
import { Services } from './pages/Services';
import { Catalog } from './pages/Catalog';
import { Trading } from './pages/Trading';
import { MetaTrader } from './pages/MetaTrader';
import { Portfolio } from './pages/Portfolio';
import { Help } from './pages/Help';

export const router = createBrowserRouter([
  {
    path: '/',
    Component: Layout,
    children: [
      { index: true, Component: Home },
      { path: 'about', Component: About },
      { path: 'services', Component: Services },
      { path: 'catalog', Component: Catalog },
      { path: 'trading', Component: Trading },
      { path: 'metatrader', Component: MetaTrader },
      { path: 'portfolio', Component: Portfolio },
      { path: 'help', Component: Help },
    ],
  },
]);
