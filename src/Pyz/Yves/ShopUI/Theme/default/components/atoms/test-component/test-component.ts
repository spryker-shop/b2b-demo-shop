import AtomTest from 'ShopUI/components/atoms/test-component/test-component';

export default class AtomTestExtended extends AtomTest {
    
    ready() { 
        console.log('this is a test 2');
    } 

    test() { 
        return 'it works!';
    }
    
}
