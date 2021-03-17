export function IsNullOrUndefined(str: string | number | null | undefined): boolean {
    if(typeof str !== 'undefined') {
        return str === null || str.toString() === '';
    }
    
    return true;
}