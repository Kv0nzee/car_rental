export const calculateCarRent = (city_mpg, year) => {
  const basePricePerDay = 50;
  const mileageFactor = 0.1;
  const ageFactor = 0.05;

  const mileageRate = city_mpg * mileageFactor;
  const ageRate = (new Date().getFullYear() - year) * ageFactor;

  const rentalRatePerDay = basePricePerDay + mileageRate + ageRate;

  return rentalRatePerDay.toFixed(0);
};

export const updateSearchParams = (type, value) => {
  const searchParams = new URLSearchParams(window.location.search);
  searchParams.set(type, value);
  const newPathname = `${window.location.pathname}?${searchParams.toString()}`;
  return newPathname;
};

export const deleteSearchParams = (type) => {
  const newSearchParams = new URLSearchParams(window.location.search);
  newSearchParams.delete(type.toLowerCase());
  const newPathname = `${window.location.pathname}?${newSearchParams.toString()}`;
  return newPathname;
};

// export async function fetchCars(filters) {
//   const { manufacturer, year, model, limit, fuel } = filters;

//   const headers = {
//     "X-RapidAPI-Key": process.env.NEXT_PUBLIC_RAPID_API_KEY || "",
//     "X-RapidAPI-Host": "cars-by-api-ninjas.p.rapidapi.com",
//   };

//   const response = await fetch(
//     `https://cars-by-api-ninjas.p.rapidapi.com/v1/cars?make=${manufacturer}&year=${year}&model=${model}&limit=${limit}&fuel_type=${fuel}`,
//     {
//       headers: headers,
//     }
//   );

//   const result = await response.json();

//   return result;
// }

export const generateCarImageUrl = (car, angle, randomPaintId) => {
  const url = new URL("https://cdn.imagin.studio/getimage");
  const { brand_name, name, year } = car;

  url.searchParams.append('customer', 'carwow' || '');
  url.searchParams.append('make', brand_name);
  url.searchParams.append('modelFamily', name.split(" ")[0]);
  url.searchParams.append('zoomType', 'fullscreen');
  url.searchParams.append('modelYear', `${year}`);

  // // Array of paintIds
  // const paintIds = ["pspc0150", "pspc0028", "pspc0317", "pspc0076", "pspc0064", "pspc0109"];
  // // Randomly select a paintId from the array
  // const randomPaintId = paintIds[Math.floor(Math.random() * paintIds.length)];

  url.searchParams.append('paintId', randomPaintId);
  if(angle){
    url.searchParams.append('angle', `${angle}`);
  }

  return `${url}`;
};

